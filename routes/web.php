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


//Route::get('/', 'PagesController@index');
Route::resource('/','AgenciesController');
Route::get('/request', 'PagesController@request');
Route::get('/logs', 'PagesController@logs');
Route::any('/done', 'ParameterController@done');
Route::any('/unDone', 'ParameterController@unDone');
Route::get('/request/file', 'PagesController@requestFile');
Route::any('/requestParameter', 'ParameterController@request');
Route::any('/changeAccHead', 'AreaController@changeAccHead');
Route::get('/accreditation/{agencyId}', 'PagesController@departments');
Route::resource('accreditation','AgenciesController');
Route::get('/profile', 'PagesController@profile');
Route::any('/accreditation/{agency}/department/{department}/areas/{access}/parameters', 'ParameterController@index');
Route::any('/accreditation/{agency}/department/{department}/areas/{access}/parameters/{parameter}/bench', 'ParameterController@bench');
Route::any('/insertParameter', 'ParameterController@store');
Route::any('/editParameter', 'ParameterController@update');
Route::any('/deleteParameter', 'ParameterController@destroy');
Route::any('/displayRequest', 'PagesController@displayRequest');
Route::any('/approveRequest', 'PagesController@approveRequest');
Route::any('/declineRequest', 'PagesController@declineRequest');
Route::any('/approveRequestFile', 'PagesController@approveRequestFile');
Route::any('/declineRequestFile', 'PagesController@declineRequestFile');
Auth::routes(); 
//Route::get('/home', 'HomeController@index')->name('home'); 
// Route::get('/contacts', 'ContactsController@get');
Route::get('/messenger', 'PagesController@messenger');
Route::any('/displayMessages', 'ChatController@displayMessages');
Route::any('/sendMessage', 'ChatController@sendMessage');
Route::any('/isTyping','ChatController@isTyping');
Route::any('/retrieveChatMessages', 'ChatController@retrieveChatMessages');
Route::any('/notTyping', 'ChatController@notTyping');
Route::any('/retrieveExistingMessages', 'ChatController@retrieveExistingMessages');
Route::any('/retrieveTypingStatus', 'ChatController@retrieveTypingStatus');
Route::any('/insertAgency', 'AgenciesController@store');
Route::any('/editAgency', 'AgenciesController@update');
Route::any('/deleteAgency', 'AgenciesController@destroy');
Route::any('/accreditation/{agency}/department/{department}/areas', 'AreaController@index');
Route::any('/insertArea', 'AreaController@store');
Route::any('/editArea', 'AreaController@edit');
Route::any('/requestArea', 'AreaController@request');
Route::any('/editAreaHead', 'AreaController@update');
Route::any('/deleteArea', 'AreaController@destroy');
Route::any('/accreditation/{agency}/department/{department}/areas/{area}/parameters/{parameter}/bench/{benchmark}/files', 'FileController@index');
Route::any('/insertFile', 'FileController@store');
Route::any('/openFile', 'FileController@show');
Route::any('/deleteFile', 'FileController@destroy');
Route::any('/downloadFile', 'FileController@download');
Route::any('/requestFile', 'FileController@request');