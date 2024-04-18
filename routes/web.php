<?php

use Illuminate\Support\Facades\Route;
use App\Modules\RolePermission\Http\Controllers\RoleController;
use App\Modules\User\Http\Controllers\UserController;
use App\Modules\Color\Http\Controllers\ColorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [App\Http\Controllers\FrontendController::class,'HomePage']);

Auth::routes();
Route::get('/admin-dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin-dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/database/backup', [App\Http\Controllers\HomeController::class, 'dbBackup'])->name('database.backup');

Route::post('admin-surveygraph-filter',[
    'as' => 'admin.surveygraph.filter',
    'uses' => 'App\Http\Controllers\HomeController@surveyGraphFilter'
]);

Route::get('admin-status-change',[
    'as' => 'admin.status.change',
    'uses' => 'App\Http\Controllers\HomeController@statusChange'
]);

Route::get('admin-valuewise-report',[
    'as' => 'admin.valuewise.report',
    'uses' => 'App\Http\Controllers\HomeController@valueWiseReport'
]);

Route::get('admin-surveywise-item',[
    'as' => 'admin.surveywise.item',
    'uses' => 'App\Http\Controllers\HomeController@surveyWiseItem'
]);


Route::post('admin-surveygraph-valuewise',[
    'as' => 'admin.surveygraph.valuewise',
    'uses' => 'App\Http\Controllers\HomeController@valueWiseGraph'
]);


Route::get('admin-compare-report',[
    'as' => 'admin.compare.report',
    'uses' => 'App\Http\Controllers\HomeController@compareReport'
]);

Route::post('admin-surveygraph-compareGraph',[
    'as' => 'admin.surveygraph.compareGraph',
    'uses' => 'App\Http\Controllers\HomeController@compareGraph'
]);


Route::get('user-password-change',[
    'as' => 'user.password.change',
    'uses' => 'App\Http\Controllers\HomeController@passwordChange'
]);

Route::post('update-user-password',[
    'as' => 'update.user.password',
    'uses' => 'App\Http\Controllers\HomeController@updatePassword'
]);









//API START
Route::get('organization-getorganizationdata', [
    'as' => 'organization.getorganizationdata',
    'uses' => 'App\Modules\Organization\Http\Controllers\OrganizationController@getorganizationdata'
]);

Route::get('surveyitem-getsurveyitem', [
    'as' => 'surveyitem.getsurveyitem',
    'uses' => 'App\Modules\SurveyItem\Http\Controllers\SurveyItemController@getsurveyitem'
]);


Route::get('surveyresult-getsurveyresult', [
    'as' => 'surveyitem.getsurveyresult',
    'uses' => 'App\Modules\SurveyResult\Http\Controllers\SurveyResultController@getsurveyresult'
]);

Route::get('surveyresult-groupby-getsurveyresult', [
    'as' => 'surveyitem.groupby.getsurveyresult',
    'uses' => 'App\Modules\SurveyResult\Http\Controllers\SurveyResultController@getsurveyresultGroupBy'
]);
//API END


include 'api.php';
