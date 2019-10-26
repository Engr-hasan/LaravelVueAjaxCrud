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

Route::post('settings/bank-list-v2', "SettingsController@BankListv2");
Route::post('settings/store-bank-v2', "SettingsController@storeBankv2");
Route::get('settings/edit-bank-v2/{id}', "SettingsController@editBankv2");
Route::patch('settings/update-bank-v2/{id}', "SettingsController@updateBankv2");
Route::get('settings/bank-list-v2/delete/{id}', "SettingsController@deleteBank");