<?php

Route::get('admin-surveyitem-create', [
    'as' => 'admin.surveyitem.create',
    'uses' => 'SurveyItemController@create'
]);

Route::get('admin-surveyitem-createlv', [
    'as' => 'admin.surveyitem.createlv',
    'uses' => 'SurveyItemController@createlv'
]);


Route::get('admin-surveyitem-index', [
    'as' => 'admin.surveyitem.index',
    'uses' => 'SurveyItemController@index'
]);

Route::post('admin-surveyitem-store',[
    'as' => 'admin.surveyitem.store',
    'uses' => 'SurveyItemController@store'
]);

Route::get('admin-surveyitem-edit/{id}',[
    'as' => 'admin.surveyitem.edit',
    'uses' => 'SurveyItemController@edit'
]);

Route::PATCH('admin-surveyitem-update/{id}',[
    'as' => 'admin.surveyitem.update',
    'uses' => 'SurveyItemController@update'
]);

Route::get('admin-surveyitem-inactive/{id}',[
    'as' => 'admin.surveyitem.inactive',
    'uses' => 'SurveyItemController@inactive'
]);

Route::get('admin-surveyitem-delete/{id}',[
    'as' => 'admin.surveyitem.delete',
    'uses' => 'SurveyItemController@delete'
]);


