<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Cache;

class IdentifyStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): mixed
    {
        $host = $request->getHost();

        // Intenta obtener la tienda de la caché
        $store = Cache::remember("store_{$host}", 60, function () use ($host): ?Store {
            return Store::where('store_url', $host)->first();
        });

        if ($store) {
            session(['store_id' => $store->id, 'store' => $store]);
        } else {
            abort(404, 'Store not found');
        }

        return $next($request);
    }
}
