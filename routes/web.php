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
Route::get('user/logout','HomepageController@logout')->name('user.logout');

Route::group(['middleware' => 'auth:web'],function(){
   // routes
    Route::get('user/edit/profile/{id}','UserController@editProfile')->name('user.edit.profile');
    Route::post('update/profile','UserController@updateProfile')->name('user.update.profile');
});


Route::get('/home', 'HomeController@index')->name('home');
