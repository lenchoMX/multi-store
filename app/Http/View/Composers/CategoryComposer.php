<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\CategoryStore;

class CategoryComposer
{
    public function compose(View $view)
    {
        $storeId = session('store_id');
        
        $categories = Cache::remember('categories_'.$storeId, 60*60, function () use ($storeId) {
            return CategoryStore::with(['category', 'children'])
                ->where('store_id', $storeId)
                ->whereNull('parent_id')
                ->get();
        });

        $view->with('categories', $categories);
    }
}
