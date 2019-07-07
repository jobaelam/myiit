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
Route::resource('accreditation','AgenciesController');
Route::get('/profile', 'PagesController@profile');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home'); 
Route::get('/contacts', 'ContactsController@get');
Route::get('/messenger', 'PagesController@messenger');
Route::get('/displayMessages', 'ChatController@displayMessages');
Route::any('/sendMessage', 'ChatController@sendMessage');
Route::any('/isTyping','ChatController@isTyping');
Route::any('/retrieveChatMessages', 'ChatController@retrieveChatMessages');
Route::any('/notTyping', 'ChatController@notTyping');
Route::any('/retrieveExistingMessages', 'ChatController@retrieveExistingMessages');
Route::any('/retrieveTypingStatus', 'ChatController@retrieveTypingStatus');
Route::any('/insertAgency', 'AgenciesController@store');
Route::any('/areas/{id}', 'AreaController@index');
Route::any('/insertArea', 'AreaController@store');
Route::any('/showAreaHead', 'AreaController@showAreaHead');
Route::any('/files/{id}', 'FileController@index');
Route::any('/insertFile', 'FileController@store');
Route::any('/downloadFile', 'FileController@download');