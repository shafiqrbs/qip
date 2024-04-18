<?php

use Illuminate\Support\Facades\Route;

Route::get('configuration', 'ConfigurationController@welcome');
Route::group(['module' => 'Configuration', 'middleware' => ['web','auth']], function() {
    include 'configuration.php';
});
