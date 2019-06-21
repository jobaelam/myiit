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

Route::get('/', 'PagesController@index');
Route::get('/accreditation', 'PagesController@accreditation');
Route::get('/profile', 'PagesController@profile');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contacts', 'ContactsController@get');
Route::get('/messenger', 'PagesController@messenger');
Route::post('/sendMessage', 'ChatController@sendMessage');
Route::post('/isTyping','ChatController@isTyping');
Route::post('/notTyping', 'ChatController@notTyping');
Route::post('/retrieveChatMessages', 'ChatController@retrieveChatMessages');
Route::post('/retrieveExistingMessages', 'ChatController@retrieveExistingMessages');
Route::post('/retrieveTypingStatus', 'ChatController@retrieveTypingStatus');