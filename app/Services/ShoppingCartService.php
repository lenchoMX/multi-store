<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;

/**
 * Class ShoppingCartService.
 */
class ShoppingCartService
{
    public function getCookieUser()
    {
        if (Cookie::get('cart') !== null) {
            return unserialize(Cookie::get('cart'));
        } else {
            $ProductData=[
                'products_quantity' => 0,
                'total_items' => 0
            ];
            return $ProductData;
        }
    }
}
