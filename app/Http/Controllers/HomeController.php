<?php

namespace App\Http\Controllers;

use App\Models\CategoryStore;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Obtén la tienda de la sesión
        $currentStore = session('store');
        $theme = $currentStore->theme;
        $view = "home.index.{$theme->name}";

        // Obtén las categorías destacadas de CategoryStore
        $categoryStores = CategoryStore::where('store_id', $currentStore->id)
            ->where('is_featured', true)
            ->with('category')
            ->with(['productStores' => function ($query) use ($currentStore) {
                $query->where('store_id', $currentStore->id)
                    ->with('image')
                    ->with('product');
            }])
            ->get();

        // Mapea los datos para ajustarlos al formato deseado
        $mappedCategories = $categoryStores->map(function ($categoryStore) {
            return [
                'name' => $categoryStore->category->name,
                'slug' => $categoryStore->category->slug,
                'products' => $categoryStore->productStores->map(function ($productStore) {
                    return [
                        'price' => $productStore->price,
                        'name' => $productStore->product->name,
                        'slug' => $productStore->product->slug,
                        'image' => $productStore->image->name,
                    ];
                })
            ];
        });

        return view($view, ['categoriesData' => $mappedCategories]);
    }
}