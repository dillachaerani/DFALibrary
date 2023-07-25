<?php

use Illuminate\Support\Facades\Route;

Route::prefix('permissions')->group(function () {
    $key = "permissions";
    // VIEW
    Route::middleware("permission:$key.index")->group(function () {
        Route::get('/', 'PermissionController@index')->name('permissions.index');
        Route::get('show/{permission}', 'PermissionController@show')->name('permissions.show');
        Route::get('sheet/sync', 'PermissionController@sheetSync')->name('permissions.sheet_sync');
    });
    // CREATE
    Route::middleware("permission:$key.create")->group(function () {
        Route::get('create', 'PermissionController@create')->name('permissions.create');
        Route::post('/', 'PermissionController@store')->name('permissions.store');
    });
    // UPDATE
    Route::middleware("permission:$key.update")->group(function () {
        Route::get('{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
        Route::put('{permission}', 'PermissionController@update')->name('permissions.update');
    });
    // DELETE
    Route::middleware("permission:$key.delete")->group(function () {
        Route::prefix('delete')->group(function () {
            Route::delete('{permission}', 'PermissionController@destroy')->name('permissions.destroy');
            Route::post('selected', 'PermissionController@destroySelected')->name('permissions.delete_selected');
            Route::post('all', 'PermissionController@destroyAll')->name('permissions.delete_all');
        });
    });
    // RESTORE
    Route::middleware("permission:$key.restore")->group(function () {
        Route::prefix('restore')->group(function () {
            Route::get('{permission}', 'PermissionController@restore')->name('permissions.restore');
            Route::post('selected', 'PermissionController@restoreSelected')->name('permissions.restore_selected');
            Route::post('all', 'PermissionController@restoreAll')->name('permissions.restore_all');
        });
    });
});
