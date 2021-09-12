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

Route::get('/admin', 'AdminController@loginAdmin');
Route::get('/adminLogout', 'AdminController@logoutAdmin');
Route::post('/admin', 'AdminController@postLoginAdmin');

Route::get('/home', function () {
    return view('home');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/',[
            'as' => 'categories.index',
            'uses' => 'CategoryController@index'
        ]);
        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'CategoryController@create'
        ]);
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete'
        ]);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/',[
            'as' => 'menus.index',
            'uses' => 'MenuController@index'
        ]);
        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'MenuController@create'
        ]);
        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete'
        ]);

    });

    Route::prefix('products')->group(function () {
        Route::get('/',[
            'as' => 'products.index',
            'uses' => 'AdminProductController@index'
        ]);
        Route::get('/create',[
            'as' => 'products.create',
            'uses' => 'AdminProductController@create'
        ]);
        Route::post('/store',[
            'as' => 'products.store',
            'uses' => 'AdminProductController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'products.edit',
            'uses' => 'AdminProductController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'products.update',
            'uses' => 'AdminProductController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'products.delete',
            'uses' => 'AdminProductController@delete'
        ]);
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

