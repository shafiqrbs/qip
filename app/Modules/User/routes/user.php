<?php

Route::get('admin-user-create', [
    'as' => 'admin.user.create',
    'uses' => 'UserController@create'
]);

Route::get('admin-user-index', [
    'as' => 'admin.user.index',
    'uses' => 'UserController@index'
]);

Route::post('admin-user-store',[
    'as' => 'admin.user.store',
    'uses' => 'UserController@store'
]);

Route::get('admin-user-edit/{id}',[
    'as' => 'admin.user.edit',
    'uses' => 'UserController@edit'
]);

Route::PATCH('admin-user-update/{id}',[
    'as' => 'admin.user.update',
    'uses' => 'UserController@update'
]);

Route::get('admin-user-delete/{id}',[
    'as' => 'admin.user.delete',
    'uses' => 'UserController@delete'
]);

Route::get('admin-user-inactive/{id}',[
    'as' => 'admin.user.inactive',
    'uses' => 'UserController@inactive'
]);








