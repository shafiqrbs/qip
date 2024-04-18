<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\MasterData\Models\ProductBrand;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/api/organization/getorganizationdata', [App\Http\Controllers\ApiController::class,'getorganizationdata']);
Route::get('/api/survey/getsurveydata', [App\Http\Controllers\ApiController::class,'getsurveydata']);
Route::get('/api/surveyitem/getsurveyitem', [App\Http\Controllers\ApiController::class,'getsurveyitem']);

Route::POST('/api/surveyresult/create', [App\Http\Controllers\ApiController::class,'createSurveyResult']);

Route::get('/api/surveyresult/getsurveyresult', [App\Http\Controllers\ApiController::class,'getsurveyresult']);
Route::get('/api/surveyresult/getsurveyresultGroupBy', [App\Http\Controllers\ApiController::class,'getsurveyresultGroupBy']);

Route::POST('/api/survey/login', [App\Http\Controllers\ApiController::class,'surveyLogin']);
Route::POST('/api/surveyresult/chart', [App\Http\Controllers\ApiController::class,'surveyResultChart']);







