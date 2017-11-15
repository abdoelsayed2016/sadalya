<?php

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
Route::group( [ 'prefix' => '/admin', 'middleware' => [ 'auth' ] ], function () {
		Route::get('/', function () {
			return view('admin.layouts.master');
		});
		Route::prefix('categories')->group(function() {

		Route::get('/', 'admin\CategoriesController@index')->name('categories.index');

		Route::get('/create', 'admin\CategoriesController@create')->name('categories.create');

		Route::post('/store', 'admin\CategoriesController@store')->name('categories.store');

		Route::get('/{category}/edit', 'admin\CategoriesController@edit')->name('categories.edit');

		Route::put('/{category}/update', 'admin\CategoriesController@update')->name('categories.update');

			Route::delete('/{category}/destroy', 'admin\CategoriesController@destroy')->name('categories.destroy');

		});
		Route::prefix('products')->group(function() {

			Route::get('/', 'admin\ProductsController@index')->name('products.index');

			Route::get('/create', 'admin\ProductsController@create')->name('products.create');

			Route::post('/store', 'admin\ProductsController@store')->name('products.store');

			Route::get('/{product}/show', 'admin\ProductsController@show')->name('products.show');

			Route::get('/{product}/edit', 'admin\ProductsController@edit')->name('products.edit');

			Route::put('/{product}/update', 'admin\ProductsController@update')->name('products.update');

			Route::delete('/{product}/destroy', 'admin\ProductsController@destroy')->name('products.destroy');

			Route::get('/out-of-date', 'admin\ProductsController@outdate')->name('products.outdate');
			Route::get('/count', 'admin\ProductsController@count')->name('products.count');

		});

});
//Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
