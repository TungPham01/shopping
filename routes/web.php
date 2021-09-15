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

Route::get('/admin', 'AdminController@loginAdmin')->name('admin.login');
Route::get('/adminLogout', 'AdminController@logoutAdmin')->name('admin.logout');
Route::post('/admin', 'AdminController@postLoginAdmin');

Route::get('/home', function () {
    return view('admin.home');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/','CategoryController@index')->name('categories.index');
        Route::get('/create','CategoryController@create')->name('categories.create');
        Route::post('/store','CategoryController@store')->name('categories.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('categories.edit');
        Route::post('/update/{id}','CategoryController@update')->name('categories.update');
        Route::get('/delete/{id}','CategoryController@delete')->name('categories.delete');
    });

    Route::prefix('menus')->group(function () {
        Route::get('/','MenuController@index')->name('menus.index');
        Route::get('/create','MenuController@create')->name('menus.create');
        Route::post('/store','MenuController@store')->name('menus.store');
        Route::get('/edit/{id}','MenuController@edit')->name('menus.edit');
        Route::post('/update/{id}','MenuController@update')->name('menus.update');
        Route::get('/delete/{id}','MenuController@delete')->name('menus.delete');
    });

    Route::prefix('products')->group(function () {
        Route::get('/','AdminProductController@index')->name('products.index');
        Route::get('/create','AdminProductController@create')->name('products.create');
        Route::post('/store','AdminProductController@store')->name('products.store');
        Route::get('/edit/{id}','AdminProductController@edit')->name('products.edit');
        Route::post('/update/{id}','AdminProductController@update')->name('products.update');
        Route::get('/delete/{id}','AdminProductController@delete')->name('products.delete');
    });
    Route::prefix('sliders')->group(function () {
        Route::get('/','SliderController@index')->name('sliders.index');
        Route::get('/create','SliderController@create')->name('sliders.create');
        Route::post('/store','SliderController@store')->name('sliders.store');
        Route::get('/edit/{id}','SliderController@edit')->name('sliders.edit');
        Route::post('/update/{id}','SliderController@update')->name('sliders.update');
        Route::get('/delete/{id}','SliderController@delete')->name('sliders.delete');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/','SettingController@index')->name('setting.index');
        Route::get('/create','SettingController@create')->name('setting.create');
        Route::post('/store','SettingController@store')->name('setting.store');
        Route::get('/edit/{id}','SettingController@edit')->name('setting.edit');
        Route::post('/update/{id}','SettingController@update')->name('setting.update');
        Route::get('/delete/{id}','SettingController@delete')->name('setting.delete');
    });
});


Route::get('','Frontend\HomeController@index')->name('front.home');
Route::get('/category/{slug}/{id}','Frontend\CategoryController@index')->name('front.category');

