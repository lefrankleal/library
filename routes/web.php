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

Route::get(
    '/', function () {
        return view('welcome');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/add-to-cart/{book}', 'CartController@add')->name('add-to-cart');
Route::put('/update-cart/{cart}', 'CartController@update')->name('update-cart');
Route::delete('/remove-item/{cart}', 'CartController@destroy')->name('remove-item');
Route::post('/confirm-cart', 'CartController@confirm')->name('confirm-cart');
Route::post('/cancel-cart', 'CartController@cancel')->name('cancel-cart');
