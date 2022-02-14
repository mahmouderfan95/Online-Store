<?php
    use Illuminate\Support\Facades\Route;
    // routes dashbord
    Route::group(['prefix' => 'admin'],function (){
       Route::get('login','DashbordController@login')->name('admin.login');
       Route::post('post/login','DashbordController@postLogin')->name('admin.post.login');


    });

    Route::group(['prefix' => 'admin','middleware' => 'auth:admin'],function (){
        Route::get('dashbord','DashbordController@dashbord')->name('admin.dashbord');
        Route::post('logout','DashbordController@logout')->name('admin.logout');
        // categories route
        Route::resource('categories','CategoryController');
        Route::resource('products','ProductController');
    })




?>
