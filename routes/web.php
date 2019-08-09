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
//Das ist die Route, die dich immer auf die Login-seite bringt, wenn du nicht eingeloggt bist.
Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

//Get Routen
/*
|	Das sind die Routen, die getriggert werden, wenn ein Benutzer z.B /home aufruft.
|	Wenn nun jemand /home aufruft, wird MyController getriggert und ruft die Methode index in
|	MyController auf. Die Methode Index liefert dem benutzer dann die Website => siehe MyController.php
*/
Route::get('/home', 'MyController@index');
Route::get('/firstsite','MyController@index');
Route::get('/dashboard','MyController@dashboard');
Route::get('/managerp','MyController@managerp');
Route::get('/managekey','MyController@managekey');
Route::get('/manageuser','MyController@manageuser');
Route::get('/keyhistory','MyController@keyhistory');
Route::get('/managekeyperms','MyController@managekeyperms');

//Post Routen
/*
|	Das sind die Routen, die getriggert werden, wenn ein Benutzer auf z.B der Seite /storeShelf ist und
|	den Senden button betätigt. Die Daten werden mit der POST funktion aus den Textfeldern entnommen,
|	weitergegeben und verarbeitet. Genau so wie bei den GET Routen ruft diese Route auch MyController auf
|	nur diesmal die Funktion storeShelf.
|
*/
Route::post('/storeShelf','MyController@storeShelf');
Route::post('/storeKey','MyController@storeKey');
Route::post('/storeKeyIntoShelf','MyController@storeKeyIntoShelf');
Route::post('/takeKeyOutOfShelf','MyController@takeKeyOutOfShelf');
Route::post('/deleteKey','MyController@deleteKey');
Route::post('/deleteShelf','MyController@deleteShelf');
Route::post('/renameKey','MyController@renameKey');
Route::post('/renameShelf','MyController@renameShelf');

