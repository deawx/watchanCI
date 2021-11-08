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

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::namespace('Auth')->group(function () {
	Route::post('/login','LoginController@login')->name('login');
});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'visit'], function () {
	Route::get('/','visitController@index');
	Route::get('/form','visitController@form')->name('visit.form');
	Route::get('/regis','visitController@regis')->name('visit.regis');
	Route::get('/{id}','visitController@show')->name('visit.show');
	Route::get('/addExtra/{id}','visitController@addExtra')->name('visit.addExtra');
	Route::get('/addNote/{id}','visitController@addNote')->name('visit.addNote');
	Route::get('/edit/{id}','visitController@edit')->name('visit.edit');
	Route::get('/orderConfirm/{id}','visitController@orderConfirm')->name('visit.orderConfirm');
	Route::get('/orderRecheck/{id}','visitController@orderRecheck')->name('visit.orderRecheck');
	Route::get('/refer/{id}','visitController@refer')->name('visit.refer');
	Route::get('/discharge/{id}','visitController@discharge')->name('visit.discharge');
	Route::get('/cert/{id}','visitController@cert')->name('visit.cert');
});

Route::group(['prefix' => 'order'], function () {
	Route::get('/','orderController@index');
	Route::get('/addStd','orderController@addStd')->name('order.addStd');
});

Auth::routes();

