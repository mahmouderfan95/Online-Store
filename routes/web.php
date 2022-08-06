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
Auth::routes();
Route::get('/','HomepageController@index')->name('homepage');
Route::get('products/details/{name}','HomepageController@product_details')->name('product.details');
Route::group(['middleware' => 'auth:web'],function(){
   // routes
    Route::get('user/logout','HomepageController@logout')->name('user.logout');
    Route::get('user/edit/profile/{id}','UserController@editProfile')->name('user.edit.profile');
    Route::post('update/profile','UserController@updateProfile')->name('user.update.profile');
    // favorites routes
    Route::post('product/add/favorite','FavoriteController@add_product')->name('product.add.fav');
    Route::get('user/favorites','FavoriteController@get_products')->name('users.favorites');
    // cart route
    Route::post('product/add/cart','CartController@add_product')->name('cart.product.add');
    Route::get('user/cart','CartController@getProductFromCart')->name('cart.get.products');
    Route::get('cart/{cart_id}/product/{product_id}/delete','CartController@deleteProductFromCart')->name('cart.product.delete');
    Route::post('confirm/cart','CartController@confirmCart')->name('cart.product.confirm');
});


Route::get('/home', 'HomeController@index')->name('home');
