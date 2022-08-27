<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
//use App\Http\Controllers\ProductController;
use App\Http\Controllers\Frontend\StripeController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Auth\GoogleSocialiteController;


//Google login
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::post('/paymentStatus',[CheckoutController::class,'removeCart']);

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class,'index'])->name('home');
Route::get('category',[App\Http\Controllers\Frontend\FrontendController::class,'category']);
Route::get('category/{slug}',[App\Http\Controllers\Frontend\FrontendController::class,'viewcategory']);

Route::get('product-list',[App\Http\Controllers\Frontend\FrontendController::class,'productlistAjax']);

Route::post('search-product',[App\Http\Controllers\Frontend\FrontendController::class,'searchProduct']);

Route::get('category/{cat_slug}/{prod_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'viewproduct']);
Route::post('/add-to-cart',[CartController::class,'addProduct']);
Route::post('/delete-cart-item',[CartController::class,'deleteProduct']);
Route::post('/update-cart',[CartController::class,'updateProduct']);
Route::get('/load-cart-data',[CartController::class,'cartCount']);
Route::get('/load-wishlist-data',[WishlistController::class,'wishlistcount']);

Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class,'viewcart']);
    Route::get('checkout',[CheckoutController::class,'index']);
    Route::post('place-order',[CheckoutController::class,'placeOrder']);
    Route::get('my-orders',[UserController::class,'index']);
    Route::get('view-order/{id}',[UserController::class,'view']);

    Route::get('wishlist',[WishlistController::class,'index']);
    Route::post('/add-to-wishlist',[WishlistController::class,'store']);
    Route::post('/delete-wishlist-item',[WishlistController::class,'destroy']);

    Route::post('/proceed-to-pay',[CheckoutController::class,'razorPayCheck']);

    Route::post('/docheckout',[CheckoutController::class,'doCheckout']);

    

    Route::post('/add-rating',[RatingController::class,'store']);

    Route::get('add-review/{product_slug}/userreview',[ReviewController::class,'index']);

    Route::post('add-review',[ReviewController::class,'store']);

    Route::get('edit-review/{product_slug}/userreview',[ReviewController::class,'edit']);

    Route::put('update-review',[ReviewController::class,'update']);
});

Route::view('/check','layouts.admin');
//Route::get('/', [ProductController::class, 'productList'])->name('products.list');

// Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
// Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
// Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
// Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::resource('vendor',VendorController::class);

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard',[FrontendController::class,'index']);

    //For Categories
    Route::get('/categories',[CategoryController::class,'index']);

    Route::get('add-category',[CategoryController::class,'add']);

    Route::post('/insert',[CategoryController::class,'insert']);

    Route::get('edit-category/{id}',[CategoryController::class,'edit']);

    Route::put('update-category/{id}',[CategoryController::class,'update']);

    Route::get('delete-category/{id}',[CategoryController::class,'destroy']);

    //For Products
    Route::get('/products',[ProductController::class,'index']);

    Route::get('add-product',[ProductController::class,'add']);

    Route::post('/insert',[ProductController::class,'insert']);

    Route::get('edit-product/{id}',[ProductController::class,'edit']);

    Route::put('update-product/{id}',[ProductController::class,'update']);

    Route::get('delete-product/{id}',[ProductController::class,'destroy']);

    Route::get('users',[FrontendController::class,'users']);

    Route::get('view-user/{id}',[FrontendController::class,'viewUser']);

    Route::get('orders',[OrderController::class,'index']);

    Route::get('admin/view-order/{id}',[OrderController::class,'view']);

    Route::put('update-order/{id}',[OrderController::class,'updateOrder']);

    Route::get('order-history',[OrderController::class,'OrderHistroy']);
});
