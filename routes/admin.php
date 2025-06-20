<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StoreInfoController;
use App\Http\Controllers\Api\ProductApiController;

// Route::resource('product', ProductController::class);


Route::middleware(['auth'])->group(function () {

   Route::prefix('admin')->group(function () {
        // dashbord
        Route::get('/dashboards', [DashboardController::class, 'index'])->name('admin.dashboard');

        // product
        Route::resource('products', ProductController::class);


        // categories
        Route::resource('categorys', CategoryController::class);
        // Route::view('/categories', 'admin.categories')->name('admin.categories');

        // Discount
        Route::resource('discounts', DiscountController::class);
        // Route::view('/discount', 'admin.discount')->name('admin.discount');

        // orders
        Route::resource('orders', OrderController::class);
        Route::POST('orders/updateStutes/{id}', [OrderController::class, 'updateStutes'])->name('orders.updateStutes');
        // web.php
        Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('admin.orders.invoice.pdf');

        // Route::view('/orders', 'admin.orders')->name('admin.orders');
        // Route::view('/orderDetails', 'admin.orderDetails')->name('admin.orderDetails');

        // settings
        Route::resource('settings', StoreInfoController::class);

        // customer
        Route::resource('customers', CustomerController::class);

    });
});

Route::get('/product/barcode/{barcode}', [ProductApiController::class, 'getByBarcode']);

// Route::prefix('admin')->group(function () {
//     // dashbord
//     Route::view('/', 'admin.index')->name('admin.index');

//     // product
//     Route::view('/products', 'admin.product')->name('admin.products');
//     Route::view('/addproduct', 'admin.product.addproduct')->name('admin.addproduct');

//     // categories
//     Route::view('/categories', 'admin.categories')->name('admin.categories');

//     // Discount
//     Route::view('/discount', 'admin.discount')->name('admin.discount');

//     // orders
//     Route::view('/orders', 'admin.orders')->name('admin.orders');
//     Route::view('/orderDetails', 'admin.orderDetails')->name('admin.orderDetails');

//     // settings
//     Route::view('/settings', 'admin.settings')->name('admin.settings');
// });
