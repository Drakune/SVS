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
    return redirect('login');
});

Auth::routes();

Route::get('/firstsite','MyController@index');
Route::get('/dashboard','MyController@dashboard');
Route::get('/managerp','MyController@managerp');
Route::get('/managekey','MyController@managekey');
Route::get('/manageuser','MyController@manageuser');

/*
 | Datenbank anlegen mit admins, wenn ein User kein Admin ist => normales Dashboard aufrufen.
 | Wenn User Admin ist, dann wird das adminDashboard aufgerufen!
*/
Route::post('/storeShelf','MyController@storeShelf');
Route::post('/storeKey','MyController@storeKey');
Route::post('/storeKeyIntoShelf','MyController@storeKeyIntoShelf');
Route::post('/takeKeyOutOfShelf','MyController@takeKeyOutOfShelf');
Route::post('/deleteKey','MyController@deleteKey');
Route::post('/deleteShelf','MyController@deleteShelf');
Route::post('/renameKey','MyController@renameKey');
Route::post('/renameShelf','MyController@renameShelf');

Route::get('/home', 'MyController@index');
