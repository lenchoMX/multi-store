<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_store_id' => 'required|exists:product_stores,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productStore = ProductStore::find($request->product_store_id);
        $cartItem = Cart::where([
            'session_id' => session()->getId(),
            'user_id' => Auth::id(),
            'product_store_id' => $request->product_store_id,
            'status' => 'pending',
        ])->first();

        // Calcular la cantidad total (existente + nueva)
        $newQuantity = $cartItem ? $cartItem->quantity + $request->quantity : $request->quantity;

        // Validar el stock contra la cantidad total
        if ($productStore->stock < $newQuantity) {
            return response()->json([
                'success' => false,
                'message' => 'No hay suficiente stock disponible para la cantidad solicitada',
            ], 400);
        }

        // Actualizar o crear el ítem del carrito
        if ($cartItem) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            Cart::create([
                'session_id' => session()->getId(),
                'user_id' => Auth::id(),
                'product_store_id' => $request->product_store_id,
                'quantity' => $request->quantity,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
        ], 200);
    }

    public function viewCart()
    {
        $currentStore = session('store');
        $theme = $currentStore->theme;
        $view = "cart.show.{$theme->name}";

        $cartModels = Cart::where(function ($query) {
            $query->where('session_id', session()->getId())
                ->orWhere('user_id', Auth::id());
        })->where('status', 'pending')->with('productStore.product')->get();

        return view($view, compact('cartModels'));
    }

    public function checkout(Request $request)
    {
        $store = session('store');
        $cartItems = Cart::where(function ($query) {
            $query->where('session_id', session()->getId())
                ->orWhere('user_id', Auth::id());
        })->where('status', 'pending')->with('productStore')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'El carrito está vacío');
        }

        $total = $cartItems->sum(fn($item) => $item->productStore->price * $item->quantity);

        // Crear la orden
        $order = Order::create([
            'user_id' => Auth::id(),
            'store_id' => $store->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'total' => $total,
            'status' => 'pending',
        ]);

        // Mover ítems a OrderItem
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_store_id' => $item->product_store_id,
                'quantity' => $item->quantity,
                'price' => $item->productStore->price,
            ]);
            $item->update(['status' => 'checkout']);
        }

        return redirect()->route('payment.process', $order->id);
    }

    public function completePayment(Request $request, Order $order)
    {
        // Simulación de pago (aquí integrarías tu pasarela de pago real)
        $order->update(['status' => 'completed']);
        Cart::whereIn('product_store_id', $order->items->pluck('product_store_id'))
            ->where('status', 'checkout')
            ->update(['status' => 'completed']);

        return redirect()->route('order.confirmation', $order->id)->with('success', 'Compra completada');
    }


    /* $currentStore = session('store');
    $theme = $currentStore->theme;
    $view = "cart.show.{$theme->name}"; */

    public function remove(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID inválido',
            ], 400);
        }

        $cartItem = Cart::where('id', $id)
            ->where(function ($query) {
                $query->where('session_id', session()->getId())
                    ->orWhere('user_id', Auth::id());
            })
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'El producto no se encontró en el carrito',
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado del carrito',
            'redirect' => route('cart.view'),
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('id', $id)
            ->where(function ($query) {
                $query->where('session_id', session()->getId())
                    ->orWhere('user_id', Auth::id());
            })
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'El producto no se encontró en el carrito',
            ], 404);
        }

        $productStore = $cartItem->productStore;
        if ($productStore->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'No hay suficiente stock disponible',
                'original_quantity' => $cartItem->quantity,
            ], 400);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Cantidad actualizada correctamente',
        ], 200);
    }
}
