<?php

use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DiscountController;

// Route::resource('product', ProductController::class);


Route::middleware(['auth'])->group(function () {

   Route::prefix('admin')->group(function () {
        // dashbord
        Route::view('/', 'admin.index')->name('admin.index');

        // product
        Route::resource('products', ProductController::class);

        // categories
        Route::resource('categorys', CategoryController::class);
        // Route::view('/categories', 'admin.categories')->name('admin.categories');

        // Discount
        Route::resource('discounts', DiscountController::class);
        // Route::view('/discount', 'admin.discount')->name('admin.discount');

        // orders
        Route::view('/orders', 'admin.orders')->name('admin.orders');
        Route::view('/orderDetails', 'admin.orderDetails')->name('admin.orderDetails');

        // settings
        Route::view('/settings', 'admin.settings')->name('admin.settings');
    });
});



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
