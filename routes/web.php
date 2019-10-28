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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('bank-list', "SettingsController@BankList");
Route::post('store-bank', "SettingsController@storeBank");
Route::get('edit-bank/{id}', "SettingsController@editBank");
Route::patch('update-bank/{id}', "SettingsController@updateBank");
Route::delete('bank-delete/{id}', "SettingsController@deleteBank");