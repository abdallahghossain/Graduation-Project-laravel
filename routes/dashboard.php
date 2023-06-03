<?php

use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\Auth\AuthController;
use App\Http\Controllers\dashboard\BlogController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ContactController;
use App\Http\Controllers\dashboard\CouponController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [

        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(
            [
                'middleware' => 'guest:admin',
                'as' => 'auth.',
            ],
            function () {
                Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
                Route::post('/login', [AuthController::class, 'login']);
            }
        );

        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::group([
            'prefix' => 'dashboard',
            'middleware' => 'auth:admin'
        ], function () {
            Route::view('/', 'dashboard.index')->name('dashboard.index');
            Route::resource('/admins', AdminController::class);
            Route::resource('/users', UserController::class);

            /////////////////////////////////** Categories Mangemnet*//////////////////////////

            Route::get('categories/trash', [CategoryController::class, 'trash'])
                ->name('categories.trash');
            Route::put('/categories/{id}/restore', [CategoryController::class, 'restore'])
                ->name('categories.restore');
            Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
                ->name('categories.force-delete');
            Route::resource('/categories', CategoryController::class);

            /////////////////////////////////** products Mangemnet*//////////////////////////
            Route::get('products/trash', [ProductController::class, 'trash'])
                ->name('products.trash');
            Route::put('/products/{id}/restore', [ProductController::class, 'restore'])
                ->name('products.restore');
            Route::delete('/products/{id?}/force-delete', [ProductController::class, 'forceDelete'])
                ->name('products.force-delete');
            Route::resource('/products', ProductController::class);

            // Route::resource('/sliders', SliderController::class);
            Route::get('/slider/create', [SliderController::class, "create"])->name('dashboard.slider.create');
            Route::post('/slider', [SliderController::class, "store"])->name('dashboard.slider.store');
            Route::get('/slider/list', [SliderController::class, "index"])->name('dashboard.slider.index');
            Route::get('/slider/edit/{id?}', [SliderController::class, "edit"])->name('dashboard.slider.edit');
            Route::put('/slider/update/{id?}', [SliderController::class, "update"])->name('dashboard.slider.update');
            Route::delete('/slider/delete/{id?}', [SliderController::class, "destroy"])->name('dashboard.slider.delete');
            //

            Route::get('/coupon/list', [CouponController::class, "index"])->name('dashboard.coupon.index');
            Route::get('/coupon/create', [CouponController::class, "create"])->name('dashboard.coupon.create');
            Route::post('/coupon', [CouponController::class, "store"])->name('dashboard.coupon.store');
            Route::get('/coupon/edit/{id?}', [CouponController::class, "edit"])->name('dashboard.coupon.edit');
            Route::put('/coupon/update/{id?}', [CouponController::class, "update"])->name('dashboard.coupon.update');
            Route::delete('/coupon/delete/{id?}', [CouponController::class, "destroy"])->name('dashboard.coupon.delete');
            //

            Route::get('/Contact/list', [ContactController::class, "index"])->name('dashboard.contact.index');
            Route::get('/Contact/create', [ContactController::class, "create"])->name('dashboard.contact.create');
            Route::post('/Contact', [ContactController::class, "store"])->name('dashboard.contact.store');
            Route::get('/Contact/edit/{id?}', [ContactController::class, "edit"])->name('dashboard.contact.edit');
            Route::put('/Contact/update/{id?}', [ContactController::class, "update"])->name('dashboard.contact.update');
            Route::delete('/Contact/delete/{id?}', [ContactController::class, "destroy"])->name('dashboard.contact.delete');
            //

            Route::get('/blog/list', [BlogController::class, "index"])->name('dashboard.blog.index');
            Route::get('/blog/create', [BlogController::class, "create"])->name('dashboard.blog.create');
            Route::post('/blog', [BlogController::class, "store"])->name('dashboard.blog.store');
            Route::get('/blog/edit/{id?}', [BlogController::class, "edit"])->name('dashboard.blog.edit');
            Route::put('/blog/update/{id?}', [BlogController::class, "update"])->name('dashboard.blog.update');
            Route::delete('/blog/delete/{id?}', [BlogController::class, "destroy"])->name('dashboard.blog.delete');






            Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
        });
    }
);
