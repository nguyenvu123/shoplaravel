<?php

use Illuminate\Support\Facades\Route;

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
//Fontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::post('/search', 'App\Http\Controllers\HomeController@search');



//Admin

Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@showDashboard');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');

//category product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryPoducts@add_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryPoducts@all_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryPoducts@save_category_product');
Route::get('/active_category/{id}', 'App\Http\Controllers\CategoryPoducts@active_category');
Route::get('/unactive_category/{id}', 'App\Http\Controllers\CategoryPoducts@unactive_category');
Route::get('/delete_category/{id}', 'App\Http\Controllers\CategoryPoducts@delete_category');

//Brand product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::get('/active_brand/{id}', 'App\Http\Controllers\BrandProduct@active_brand');
Route::get('/unactive_brand/{id}', 'App\Http\Controllers\BrandProduct@unactive_brand');
Route::get('/delete_brand/{id}', 'App\Http\Controllers\BrandProduct@delete_brand');

//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::get('/active_product/{id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive_product/{id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/delete_product/{id}', 'App\Http\Controllers\ProductController@delete_product');

//home page

Route::get('/category-filter-product/{id}', 'App\Http\Controllers\CategoryPoducts@fiter_category');


//detail product
Route::get('/product-detail/{id}', 'App\Http\Controllers\ProductController@detailProduct');
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@showCart');
Route::get('/deleteProduct/{id}', 'App\Http\Controllers\CartController@deleteProduct');
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@loginCheckout');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@addCustomer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/order_place', 'App\Http\Controllers\CheckoutController@orderPlace');



Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@saveShipping');
Route::get('/logout', 'App\Http\Controllers\CheckoutController@logout');
Route::post('/login', 'App\Http\Controllers\CheckoutController@login');






