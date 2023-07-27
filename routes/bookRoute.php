<?php

use Illuminate\Support\Facades\Route;

Route::prefix('books')->group(function () {
    $key = "books";
    // VIEW
    Route::middleware("permission:$key.index")->group(function () {
        Route::get('/', 'UserController@index')->name('books.index');
        Route::get('show/{user}', 'UserController@show')->name('books.show');
        Route::get('sheet/sync', 'UserController@sheetSync')->name('books.sheet_sync');
    });
    // CREATE
    Route::middleware("permission:$key.create")->group(function () {
        Route::get('create', 'UserController@create')->name('books.create');
        Route::post('/', 'UserController@store')->name('books.store');
    });
    // UPDATE
    Route::middleware("permission:$key.update")->group(function () {
        Route::get('{user}/edit', 'UserController@edit')->name('books.edit');
        Route::put('{user}', 'UserController@update')->name('books.update');
    });
    // DELETE
    Route::middleware("permission:$key.delete")->group(function () {
        Route::prefix('delete')->group(function () {
            Route::delete('{user}', 'UserController@destroy')->name('books.destroy');
            Route::post('selected', 'UserController@destroySelected')->name('books.delete_selected');
            Route::post('all', 'UserController@destroyAll')->name('books.delete_all');
        });
    });
    // RESTORE
    Route::middleware("permission:$key.restore")->group(function () {
        Route::prefix('restore')->group(function () {
            Route::get('{user}', 'UserController@restore')->name('books.restore');
            Route::post('selected', 'UserController@restoreSelected')->name('books.restore_selected');
            Route::post('all', 'UserController@restoreAll')->name('books.restore_all');
        });
    });
    // BOTH CREATE AND UPDATE
    Route::middleware("permission:$key.create|$key.update")->group(function () {
        Route::prefix('remove')->group(function () {
            Route::get('image', 'UserController@removeImage')->name('books.remove_image');
        });
    });
});
