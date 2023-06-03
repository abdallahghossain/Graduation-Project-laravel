<?php

use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/blog', [HomeController::class , 'blog'])->name("blog");
Route::view('/about','front.about')->name("about");
Route::view('/shop','front.shop')->name('shop');
Route::resource('/carts',CartController::class);
Route::get('/products/{product}',[ProductController::class,'show'])->name('single_product');
Route::view('/checkout','front.checkout')->name('checkout');
Route::get('/contact-us',[HomeController::class,'contact'])->name("contact");
Route::view('/single-product','front.single-product');
Route::get('/shop',[HomeController::class,'ShowAllPorducts'])->name('shop');



require __DIR__ . '/dashboard.php';
