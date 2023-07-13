<?php

use App\Models\Cart;
use App\Models\User;
use App\models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test', function () {
//     return view('General.about');
// });

//Checking Error Page, for HTTP Exception (mainly for 404 and 403)

Route::get('/error', function () {
    return view('error');
});

Route::get('/about', function () {
    return view('General.about');
})->name('about');

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/products', [ProductDetailController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductDetailController::class, 'detail'])->name('productDetail');

Route::get('/search', [ProductDetailController::class, 'search'])->name('search');
Route::get('/addToCart/{id}', [ProductController::class, 'store'])->name('addToCart')->middleware('addToCart');

Route::middleware(['profile'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/update', [UserController::class, 'update_page'])->name('update_page');
    Route::post('/update_attempt', [UserController::class, 'edit'])->name('update');
});

Route::middleware(['auth'])->group(function () {
    //Authenticated User Route
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware(['member'])->group(function () {
        //Member Only Route
        Route::get('/history', [HistoryController::class, 'index'])->name('history');
        Route::get('/cart', [CartController::class, 'read'])->name('cart');
        Route::post('/updateCart/{id}', [ProductController::class, 'edit'])->name("updateProductQuantity");

        Route::get('/checkOut', [CartController::class, 'checkOutPage'])->name('checkOutPage');
        Route::post('/checkOut/{id}', [HistoryController::class, 'paid'])->name('checkOut');
    });

    Route::middleware(['admin'])->group(function () {
        //Admin Only Route
        Route::get('/category', [CategoryController::class, 'show'])->name('category');
        Route::post('/add_category', [CategoryController::class, 'store'])->name('add_category');

        Route::get('/add_product', [ProductDetailController::class, 'add_page'])->name('addProductPage');
        Route::post('/add_product_attempt', [ProductDetailController::class, 'store'])->name('addProductAttempt');
        Route::post('/delete_product_{id}', [ProductDetailController::class, 'delete'])->name('deleteProductAttempt');
        Route::get('/edit_product/{id}', [ProductDetailController::class, 'edit_page'])->name('edit');
        Route::post('/edit_product_{id}_attempt', [ProductDetailController::class, 'update'])->name('editAttempt');
    });
});

Route::middleware(['guest'])->group(function () {
    // Non-Authenticated User Route (Guest)
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'signIn'])->name('signIn');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'create'])->name('create');
});
