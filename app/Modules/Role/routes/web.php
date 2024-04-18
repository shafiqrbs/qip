<?php

use Illuminate\Support\Facades\Route;

//Route::get('role', 'RoleController@welcome');

Route::group(['module' => 'Role', 'middleware' => ['web','auth']], function() {
    include 'role.php';
});