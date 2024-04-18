<?php

use Illuminate\Support\Facades\Route;

Route::group(['module' => 'SurveyResult', 'middleware' => ['web','auth']], function() {
    include 'surveyresult.php';
});