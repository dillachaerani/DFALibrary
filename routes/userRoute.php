<?php

use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    $key = "users";
    // VIEW
    Route::middleware("permission:$key.index")->group(function () {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('show/{user}', 'UserController@show')->name('users.show');
        Route::get('sheet/sync', 'UserController@sheetSync')->name('users.sheet_sync');
    });
    // CREATE
    Route::middleware("permission:$key.create")->group(function () {
        Route::get('create', 'UserController@create')->name('users.create');
        Route::post('/', 'UserController@store')->name('users.store');
    });
    // UPDATE
    Route::middleware("permission:$key.update")->group(function () {
        Route::get('{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('{user}', 'UserController@update')->name('users.update');
        Route::prefix('verification')->group(function () {
            Route::get('{user}', 'UserController@verification')->name('users.verification');
            Route::post('selected', 'UserController@verificationSelected')->name('users.verification_selected');
            Route::post('all', 'UserController@verificationAll')->name('users.verification_all');
        });
        Route::prefix('activate')->group(function () {
            Route::get('{user}', 'UserController@activate')->name('users.activate');
            Route::post('selected', 'UserController@activateSelected')->name('users.activate_selected');
            Route::post('all', 'UserController@activateAll')->name('users.activate_all');
        });
    });
    // DELETE
    Route::middleware("permission:$key.delete")->group(function () {
        Route::prefix('delete')->group(function () {
            Route::delete('{user}', 'UserController@destroy')->name('users.destroy');
            Route::post('selected', 'UserController@destroySelected')->name('users.delete_selected');
            Route::post('all', 'UserController@destroyAll')->name('users.delete_all');
        });
    });
    // RESTORE
    Route::middleware("permission:$key.restore")->group(function () {
        Route::prefix('restore')->group(function () {
            Route::get('{user}', 'UserController@restore')->name('users.restore');
            Route::post('selected', 'UserController@restoreSelected')->name('users.restore_selected');
            Route::post('all', 'UserController@restoreAll')->name('users.restore_all');
        });
    });
    // BOTH CREATE AND UPDATE
    Route::middleware("permission:$key.create|$key.update")->group(function () {
        Route::prefix('remove')->group(function () {
            Route::get('image', 'UserController@removeImage')->name('users.remove_image');
        });
    });
});
