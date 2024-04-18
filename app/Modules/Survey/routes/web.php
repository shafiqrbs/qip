<?php

use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Survey', 'middleware' => ['web','auth']], function() {
    include 'survey.php';
});