<?php

use App\Events\websocketDemo;
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

Route::get('/', function ()
{
    broadcast(new websocketDemo('datadata'));
    return view('welcome');
});

Route::get('/liveMessage', 'MessagesController@index');
Route::get('/messages', 'MessagesController@fetchMessages');
Route::post('/messages', 'MessagesController@sendMessages');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
