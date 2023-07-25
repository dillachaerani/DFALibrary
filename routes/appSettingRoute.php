<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', 'AppSettingController', ['names' => 'app_settings'])->only(['index', 'store']);