<?php

Route::get('admin-configuration-create', [
    'as' => 'admin.configuration.create',
    'uses' => 'ConfigurationController@create'
]);

Route::get('admin-configuration-index', [
    'as' => 'admin.configuration.index',
    'uses' => 'ConfigurationController@index'
]);

Route::post('admin-configuration-store',[
    'as' => 'admin.configuration.store',
    'uses' => 'ConfigurationController@store'
]);

Route::get('admin-configuration-edit/{id}',[
    'as' => 'admin.configuration.edit',
    'uses' => 'ConfigurationController@edit'
]);

Route::PATCH('admin-configuration-update/{id}',[
    'as' => 'admin.configuration.update',
    'uses' => 'ConfigurationController@update'
]);

Route::get('admin-configuration-delete/{id}',[
    'as' => 'admin.configuration.delete',
    'uses' => 'ConfigurationController@delete'
]);

Route::get('admin-configuration-inactive/{id}',[
    'as' => 'admin.configuration.inactive',
    'uses' => 'ConfigurationController@inactive'
]);


