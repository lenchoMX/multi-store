<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $shopping_cart = unserialize(Cookie::get('cart'));
        return view('checkout.cart', compact('shopping_cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $shopping_cart = unserialize(Cookie::get('cart'));
        return view('checkout.guest', compact('shopping_cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // $suburb_exp = explode('##', $request->suburb);
        $shopping_cart = unserialize(Cookie::get('cart'));

        $data = [
            'items' =>  $shopping_cart['items'],
            'payment' => [
                'currency' => 'mxn',
                'sub_total' => '10897',
                'shipping' => '10897',
                'taxes' => '10897',
                'discount' => '10897',
                'total' => '10897'
            ],
            'data'=>[
                'site_id' => $this->site_id(),
                "visitor" => request()->ip()
            ]
            
        ];

        $response = Http::retry(10, 500)
            ->withToken(env('API_CHECKOUT_TOKEN'))
            ->withOptions(['verify' => false])
            ->accept('application/json')
            ->post(env('API_CHECKOUT_URL'), $data);
        
        // return $response->json();
        return redirect()->away($response['url_redirect']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
