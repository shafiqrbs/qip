<?php

use Illuminate\Support\Facades\Route;

//Route::get('user', 'UserController@welcome');
Route::group(['module' => 'User', 'middleware' => ['web','auth']], function() {
    include 'user.php';
});
