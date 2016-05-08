<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'CustomerController@index')->name('root');
Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/getView', 'AdminController@getView')->name('admin.getView');
Route::post('admin/uploadImg', 'AdminController@uploadImg')->name('admin.uploadImg');
Route::post('admin/setView', 'AdminController@setView')->name('admin.setView');
