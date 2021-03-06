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



// cấu hình thư viện quản lý file 'laravel-filemanager'
Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::prefix('categories')->group(function () {
        Route::get('/','CategoryController@index')->name('categories.index')->middleware('can:category-list');
        Route::get('/create','CategoryController@create')->name('categories.create')->middleware('can:category-add');
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

    Route::prefix('users')->group(function () {
        Route::get('/','AdminSystemController@index')->name('users.index');
        Route::get('/create','AdminSystemController@create')->name('users.create');
        Route::post('/store','AdminSystemController@store')->name('users.store');
        Route::get('/edit/{id}','AdminSystemController@edit')->name('users.edit');
        Route::post('/update/{id}','AdminSystemController@update')->name('users.update');
        Route::get('/delete/{id}','AdminSystemController@delete')->name('users.delete');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/','AdminRoleController@index')->name('roles.index');
        Route::get('/create','AdminRoleController@create')->name('roles.create');
        Route::post('/store','AdminRoleController@store')->name('roles.store');
        Route::get('/edit/{id}','AdminRoleController@edit')->name('roles.edit');
        Route::post('/update/{id}','AdminRoleController@update')->name('roles.update');
        Route::get('/delete/{id}','AdminRoleController@delete')->name('roles.delete');
    });
});

// CLIENT
Route::get('','Frontend\FrontHomeController@index')->name('front.home');
Route::get('/category/{slug}/{id}','Frontend\FrontCategoryController@index')->name('front.category');

Route::get('/products','Frontend\FrontProductController@index')->name('front.products');

Route::get('/products/add-to-cart/{id}','Frontend\FrontProductController@addToCart')->name('front.addToCart');
Route::get('/products/show-cart','Frontend\FrontProductController@showCart')->name('front.showCart');
Route::get('/products/remove-cart/{id}','Frontend\FrontProductController@removeCart')->name('front.removeCart');
Route::get('/products/remove-all','Frontend\FrontProductController@removeAll')->name('front.removeAll');
Route::post('/products/edit-cart','Frontend\FrontProductController@editCart')->name('front.editCart');

Route::get('/products/checkout','Frontend\FrontProductController@checkOut')->name('front.checkOut');

// Local
Route::get('language/{language}', 'LanguageController@index')->name('language');