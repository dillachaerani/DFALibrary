<?php

use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    $key = "roles";
    // VIEW
    Route::middleware("permission:$key.index")->group(function () {
        Route::get('/', 'RoleController@index')->name('roles.index');
        Route::get('show/{role}', 'RoleController@show')->name('roles.show');
        Route::get('sheet/sync', 'RoleController@sheetSync')->name('roles.sheet_sync');
    });
    // CREATE
    Route::middleware("permission:$key.create")->group(function () {
        Route::get('create', 'RoleController@create')->name('roles.create');
        Route::post('/', 'RoleController@store')->name('roles.store');
    });
    // UPDATE
    Route::middleware("permission:$key.update")->group(function () {
        Route::get('{role}/edit', 'RoleController@edit')->name('roles.edit');
        Route::put('{role}', 'RoleController@update')->name('roles.update');
    });
    // DELETE
    Route::middleware("permission:$key.delete")->group(function () {
        Route::prefix('delete')->group(function () {
            Route::delete('{role}', 'RoleController@destroy')->name('roles.destroy');
            Route::post('selected', 'RoleController@destroySelected')->name('roles.delete_selected');
            Route::post('all', 'RoleController@destroyAll')->name('roles.delete_all');
        });
    });
    // RESTORE
    Route::middleware("permission:$key.restore")->group(function () {
        Route::prefix('restore')->group(function () {
            Route::get('{role}', 'RoleController@restore')->name('roles.restore');
            Route::post('selected', 'RoleController@restoreSelected')->name('roles.restore_selected');
            Route::post('all', 'RoleController@restoreAll')->name('roles.restore_all');
        });
    });
});
