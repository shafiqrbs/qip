<?php

use Illuminate\Support\Facades\Route;

Route::group(['module' => 'SurveyItem', 'middleware' => ['web','auth']], function() {
    include 'SurveyItem.php';
});