<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ShoppingCartService;

class CartItemsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $shoppingCartService = app(ShoppingCartService::class);
            $view->with('cartItems', $shoppingCartService->getCookieUser());
        });
    }

    /**
     * Bootstrap services.
     */
    public function register()
    {
        //
    }
}
