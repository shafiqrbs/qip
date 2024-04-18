<?php

Route::get('admin-survey-create', [
    'as' => 'admin.survey.create',
    'uses' => 'SurveyController@create'
]);

Route::get('admin-survey-index', [
    'as' => 'admin.survey.index',
    'uses' => 'SurveyController@index'
]);

Route::post('admin-survey-store',[
    'as' => 'admin.survey.store',
    'uses' => 'SurveyController@store'
]);

Route::get('admin-survey-edit/{id}',[
    'as' => 'admin.survey.edit',
    'uses' => 'SurveyController@edit'
]);

Route::PATCH('admin-survey-update/{id}',[
    'as' => 'admin.survey.update',
    'uses' => 'SurveyController@update'
]);

Route::get('admin-survey-inactive/{id}',[
    'as' => 'admin.survey.inactive',
    'uses' => 'SurveyController@inactive'
]);

Route::get('admin-survey-delete/{id}',[
    'as' => 'admin.survey.delete',
    'uses' => 'SurveyController@delete'
]);

Route::get('admin-survey-organization-assignperson/{id}',[
    'as' => 'admin.survey.organization.assignperson',
    'uses' => 'SurveyController@assignperson'
]);

Route::Post('admin-survey-calendarassign-search',[
    'as' => 'admin.survey.calendarassign.search',
    'uses' => 'SurveyController@calendarassignsearch'
]);

Route::get('admin-survey-calendarassign-store',[
    'as' => 'admin.survey.calendarassign.store',
    'uses' => 'SurveyController@calendarassignstore'
]);

Route::get('admin-calendar-downloadexcel',[
    'as' => 'admin.calendar.downloadexcel',
    'uses' => 'SurveyController@downloadExcel'
]);








