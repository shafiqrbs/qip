<?php

Route::get('admin-surveyresultresult-create', [
    'as' => 'admin.surveyresult.create',
    'uses' => 'SurveyResultController@create'
]);

Route::get('admin-surveyresult-index', [
    'as' => 'admin.surveyresult.index',
    'uses' => 'SurveyResultController@index'
]);

Route::post('admin-surveyresult-store',[
    'as' => 'admin.surveyresult.store',
    'uses' => 'SurveyResultController@store'
]);

Route::get('admin-surveyresult-edit/{id}',[
    'as' => 'admin.surveyresult.edit',
    'uses' => 'SurveyResultController@edit'
]);

Route::PATCH('admin-surveyresult-update/{id}',[
    'as' => 'admin.surveyresult.update',
    'uses' => 'SurveyResultController@update'
]);

Route::get('admin-surveyresult-inactive/{id}',[
    'as' => 'admin.surveyresult.inactive',
    'uses' => 'SurveyResultController@inactive'
]);

Route::get('admin-surveyresult-delete/{id}',[
    'as' => 'admin.surveyresult.delete',
    'uses' => 'SurveyResultController@delete'
]);

Route::get('admin-surveyresult-downloadCSV',[
    'as' => 'admin.surveyresult.downloadCSV',
    'uses' => 'SurveyResultController@downloadCSV'
]);


