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

Route::get('/', function () {
    return redirect('firstsite');
});

Route::get('/firstsite','MyController@index');
Route::post('/storeShelf','MyController@storeShelf');
Route::post('/storeKey','MyController@storeKey');
Route::post('/storeKeyIntoShelf','MyController@storeKeyIntoShelf');
Route::post('/takeKeyOutOfShelf','MyController@takeKeyOutOfShelf');
