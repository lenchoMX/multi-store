<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductStore;
use App\Models\Product;
use App\Models\CategoryStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;


class ProductCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Cache::remember('categories', 60 * 60, function () {
            return Category::with('childCategories')->whereNull('parent_id')->get();
        });

        return view('categories.index', compact('categories'));
    }

    public function show(string $path): View
    {
        $storeId = session('store_id');
        $currentStore = session('store');
        $theme = $currentStore->theme;
        $view = "categories.show.{$theme->name}";


        // Dividir el path en categorías y subcategorías
        $segments = explode('/', $path);

        // Obtener la categoría principal
        $category = Category::where('slug', $segments[0])->firstOrFail();

        // Obtener la categoría y sus subcategorías correspondientes a la tienda
        $categoryStore = CategoryStore::where('store_id', $storeId)
            ->where('category_id', $category->id)
            ->firstOrFail();

        for ($i = 1; $i < count($segments); $i++) {
            $categoryStore = CategoryStore::where('store_id', $storeId)
                ->where('parent_id', $categoryStore->id)
                ->whereHas('category', function ($query) use ($segments, $i) {
                    $query->where('slug', $segments[$i]);
                })->firstOrFail();
        }

        // Obtener los CategoryStore asociados a la categoría y tienda
        $categoryStores = CategoryStore::where('store_id', $storeId)
            ->where('category_id', $category->id)
            ->pluck('id');

        // Obtener los productos asociados a los CategoryStore con el nombre del producto y la marca
        $products = ProductStore::whereHas('categoryStores', function ($query) use ($categoryStores) {
            $query->whereIn('category_store_id', $categoryStores);
        })
            ->with(['product.brand'])
            ->with(['image'])
            ->get();

        // Devolver la vista con la categoría, subcategorías y productos
        return view($view, [
            'category' => $category,
            'subcategories' => CategoryStore::where('store_id', $storeId)
                ->where('parent_id', $categoryStore->id)
                ->with('category')->get(),
            'products' => $products->map(fn($productStore) => [
                'id' => $productStore->id,
                'name' => $productStore->product->name,
                'image' => $productStore->image->name,
                'brand' => $productStore->product->brand->name,
                'price' => $productStore->price,
                'stock' => $productStore->stock,
                'slug' => $productStore->product->slug,
                // Agrega más campos si es necesario
            ]),
        ]);
    }
}
