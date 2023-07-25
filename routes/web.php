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

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'verify-user']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    // accounts
    Route::resource('accounts', 'AccountController', ['names' => 'accounts'])->only(['show', 'edit', 'update']);
    Route::group(['prefix' => 'accounts'], function () {
        Route::get('delete-image/{account}', 'AccountController@removeImage')->name('accounts.delete_image');
    });
    Route::resource('settings', 'SettingController', ['middleware' => ['role:developer|superadmin']]);
});
Route::get('/', function () {
    return redirect()->action("DashboardController@index");
});
Route::get('admin', function () {
    return redirect()->action("DashboardController@index");
});
// Route::get('kirim-email','MailController@index');
