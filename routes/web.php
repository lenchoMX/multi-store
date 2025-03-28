<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;


// Ruta para productos
Route::get('/categoria/{path}/producto/{productSlug}', [ProductController::class, 'show'])
    ->where('path', '.*')
    ->where('productSlug', '[a-zA-Z0-9-_]+')
    ->name('product.show');


// Ruta para categorías y subcategorías
Route::get('/categoria/{path}', [ProductCategoryController::class, 'show'])
    ->where('path', '.*')->name('category.show');

Route::get('/categorias', [ProductCategoryController::class, 'index'])->name('category.index');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('images/{filename}', [ImageController::class, 'show'])->name('images.show');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

/////////////////////


Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/payment/{order}', [CartController::class, 'completePayment'])->name('payment.process');
Route::get('/order/{order}/confirmation', fn($order) => view('order.confirmation'))->name('order.confirmation');

//Route::get('/', [ProductController::class, 'index'])->name('product.index');
/* Route::get('/MLM-{product}-{name}.html', [ProductController::class, 'show'])->name('product.show');
Route::post('/MLM-{product}-{name}.html', [ProductController::class, 'store'])->name('product.store'); */


//Route::get('/checkout/cart', [CheckoutGuestController::class, 'index'])->name('checkout.index');
//Route::post('/checkout/cart', [CheckoutGuestController::class, 'store'])->name('checkout.store');

//Route::get('/checkout/address/guest', [CheckoutGuestController::class, 'create'])->name('checkout.guest.address.create');
//Route::post('/checkout/address/guest', [CheckoutGuestController::class, 'store'])->name('checkout.guest.address.store');

//Route::get('/checkout/address', [CheckoutGuestController::class, 'create'])->name('checkout.address.user.create');
//Route::post('/checkout/address', [CheckoutGuestController::class, 'create'])->name('checkout.address.user.store');

//Route::get('/checkout/payment', [CheckoutGuestReviewController::class, 'create'])->name('checkout.guest.review.create');

Route::post('/user/register', UserRegisterController::class)->name('user.register');
Route::post('/user/login', UserLoginController::class)->name('user.login');


/* app\Http\View\Composers\CategoryComposer.php
namespace App\Http\View\Composers;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Cache::remember('categories', 60*60, function () {
            return Category::with('childCategories')->whereNull('parent_id')->get();
        });
        $view->with('categories', $categories);
    }
}

AppServiceProvider.php
public function register(): void
    {
        View::composer('*', CategoryComposer::class);
    } */