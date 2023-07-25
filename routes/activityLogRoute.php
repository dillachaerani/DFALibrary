<?php

use Illuminate\Support\Facades\Route;

Route::prefix('activity-logs')->group(function () {
    $key = "activity_logs";
    // VIEW
    Route::middleware("permission:$key.index")->group(function () {
        Route::get('/', 'ActivityLogController@index')->name('activity_logs.index');
        Route::get('show/{activity_log}', 'ActivityLogController@show')->name('activity_logs.show');
        Route::get('sheet/sync', 'ActivityLogController@sheetSync')->name('activity_logs.sheet_sync');
    });
    // DELETE
    Route::middleware("permission:$key.delete")->group(function () {
        Route::prefix('delete')->group(function () {
            Route::delete('{activity_log}', 'ActivityLogController@destroy')->name('activity_logs.destroy');
            Route::post('selected', 'ActivityLogController@destroySelected')->name('activity_logs.delete_selected');
            Route::post('all', 'ActivityLogController@destroyAll')->name('activity_logs.delete_all');
        });
    });
    // RESTORE
    Route::middleware("permission:$key.restore")->group(function () {
        Route::prefix('restore')->group(function () {
            Route::get('{activity_log}', 'ActivityLogController@restore')->name('activity_logs.restore');
            Route::post('selected', 'ActivityLogController@restoreSelected')->name('activity_logs.restore_selected');
            Route::post('all', 'ActivityLogController@restoreAll')->name('activity_logs.restore_all');
        });
    });
});
