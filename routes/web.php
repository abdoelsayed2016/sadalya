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
	Route::prefix('delegates')->group(function() {

		Route::get('/', 'admin\DelegatesController@index')->name('delegates.index');

		Route::get('/create', 'admin\DelegatesController@create')->name('delegates.create');

		Route::post('/store', 'admin\DelegatesController@store')->name('delegates.store');

		Route::get('/{user}/edit', 'admin\DelegatesController@edit')->name('delegates.edit');

		Route::put('/{user}/update', 'admin\DelegatesController@update')->name('delegates.update');

		Route::delete('/{user}/destroy', 'admin\DelegatesController@destroy')->name('delegates.destroy');

	});
	Route::prefix('stores')->group(function() {

		Route::get('/', 'admin\StoresController@index')->name('stores.index');

		Route::get('/create', 'admin\StoresController@create')->name('stores.create');

		Route::post('/store', 'admin\StoresController@store')->name('stores.store');

		Route::get('/{store}/edit', 'admin\StoresController@edit')->name('stores.edit');

		Route::put('/{store}/update', 'admin\StoresController@update')->name('stores.update');

		Route::delete('/{store}/destroy', 'admin\StoresController@destroy')->name('stores.destroy');

	});

});
//Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
