<?php

namespace App\Http\Middleware;

use App\Models\AnonymousCart;
use App\Models\CartItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $sessionId = session()->getId();
            $anonymousCart = AnonymousCart::where('session_id', $sessionId)->get();

            foreach ($anonymousCart as $item) {
                CartItem::updateOrCreate(
                    ['user_id' => Auth::id(), 'product_id' => $item->product_id],
                    ['quantity' => $item->quantity]
                );
            }

            AnonymousCart::where('session_id', $sessionId)->delete();
        }

        return $next($request);
    }
}
