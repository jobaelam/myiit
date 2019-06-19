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
Route::get('/messeger', 'PagesController@messenger');
Route::get('/profile', 'PagesController@profile');

// Route::view('/home', 'welcome');

// Route::get('accreditation', function(){
//     return view('pages.accreditation');}
// );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contacts', 'ContactsController@get');