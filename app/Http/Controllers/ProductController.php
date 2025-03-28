<?php

namespace App\Http\Controllers;

use App\Models\CategoryStore;
use App\Models\ProductStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Obtener el store_id de la sesión
        $storeId = session('store_id');

        $categories = CategoryStore::where('store_id', $storeId)
            ->with(['Category', 'Store'])
            ->get();


        return $categories;
    }

    public function index2(Request $request) //: View
    {
        // Obtener el store_id de la sesión
        $storeId = session('store_id');

        // Cargar los 10 primeros productos de la tienda específica junto con sus relaciones
        $productStores = ProductStore::where('store_id', $storeId)
            ->with(['Currency', 'Description', 'Image', 'Product', 'ShortDescription', 'product.Brand'])
            ->take(10)
            ->get()
            ->map(function ($productStore) {
                $product = $productStore->product;

                // Filtrar las relaciones para eliminar los campos no deseados
                $descriptions = $product->descriptions->map(function ($description) {
                    return [
                        'content' => $description->content // Ajustar según la estructura real de tu tabla
                    ];
                });
                $images = $product->images->map(function ($image) {
                    return [
                        'url' => $image->url // Ajustar según la estructura real de tu tabla
                    ];
                });
                $brand = [
                    'name' => $product->brand->name // Ajustar según la estructura real de tu tabla
                ];

                // Filtrar los campos del producto
                return [
                    'name' => $product->name,
                    'price' => $productStore->price, // Precio de ProductStore
                    'currency' => $productStore->currency->code, // Moneda desde ProductStore
                    'descriptions' => $descriptions,
                    'images' => $images,
                    'brand' => $brand,
                ];
            });

        // Pasar la configuración de la tienda a la vista
        $store = session('store');

        return $productStores;

        return view('product.index', compact('productStores', 'store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($product, Request $request)
    {

        $product = ProductStore::where('id', $product)
            ->with('Product')
            ->first();

        $itemsData = [
            'id' => $product->id,
            'name' => $product->Product->name,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'sub_total' => $product->price * $request->quantity
        ];

        $productsData = [
            'products_quantity' => 1,
            'total_items' => $product->price * $request->quantity
        ];

        if (Cookie::get('cart') === null) {
            Cookie::queue('cart', serialize(array_merge(['items' => [$itemsData]], $productsData)));
            return back()->with(['productAdd' => 'success']);
        }

        $cart_json = unserialize(Cookie::get('cart'));

        $id_items = array_column($cart_json['items'], 'id');
        $found_key = array_search($product->id, $id_items);

        // $found_key = array_search($product->id, array_column($cart_json, 'id'));
        if ($found_key != '') {
            $cart_json['items'][$found_key]['quantity'] = $request->quantity + $cart_json['items'][$found_key]['quantity'];
            $cart_json['items'][$found_key]['sub_total'] = $product->price * $cart_json['items'][$found_key]['quantity'];
            $cart_json['total_items'] = number_format(array_sum(array_column($cart_json['items'], 'sub_total')), 2);
            Cookie::queue('cart', serialize($cart_json));
        } else {
            $cart_json['products_quantity'] = $cart_json['products_quantity'] + 1;
            $cart_json['total_items'] = number_format(array_sum(array_column($cart_json['items'], 'sub_total')), 2);
            array_push($cart_json['items'], $itemsData);
            Cookie::queue('cart', serialize($cart_json));
        }

        return back()->with(['productAdd' => 'success']);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $path, string $productSlug): View
    {
        // Acceder a los datos de la tienda desde la sesión
        $store = session('store');
        $storeId = $store->id;
        $theme = $store->theme;
        $view = "products.show.{$theme->name}";

        // Obtener el producto de la tienda con el slug dado
        $productStore = ProductStore::whereHas('product', function ($query) use ($productSlug) {
            $query->where('slug', $productSlug);
        })->where('store_id', $storeId)
            ->with(['currency'])
            ->with(['description'])
            ->with(['image'])
            ->with(['product.brand'])
            ->with(['product.features'])
            ->with(['product.images'])
            ->firstOrFail();

        $transformedProductStore = [
            'id' => $productStore->id,
            'status' => $productStore->status,
            'price' => $productStore->price,
            'currency' => $productStore->currency->code,
            'description' => $productStore->description->description,
            'image' => $productStore->image->name,
            'product' => [
                'name' => $productStore->product->name,
                'slug' => $productStore->product->slug,
                'price' => $productStore->product->price,
                'brand' => [
                    'name' => $productStore->product->brand->name,
                    'slug' => $productStore->product->brand->slug,
                ],
                'features' => $productStore->product->features->map(fn($feature) => [
                    'name' => $feature->name,
                    'parent' => $feature->parent ? $feature->parent->name : null,
                ]),
                'images' => $productStore->product->images->map(fn($image) => $image->name),
            ],
        ];

        return view($view, ['productStore' => $transformedProductStore]);
    }
}
