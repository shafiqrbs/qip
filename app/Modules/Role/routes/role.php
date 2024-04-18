<?php

Route::get('admin-role-create', [
    'as' => 'admin.role.create',
    'uses' => 'RoleController@create'
]);

Route::get('admin-role-index', [
    'as' => 'admin.role.index',
    'uses' => 'RoleController@index'
]);

Route::post('admin-role-store',[
    'as' => 'admin.role.store',
    'uses' => 'RoleController@store'
]);

Route::get('admin-role-edit/{id}',[
    'as' => 'admin.role.edit',
    'uses' => 'RoleController@edit'
]);

Route::PATCH('admin-role-update/{id}',[
    'as' => 'admin.role.update',
    'uses' => 'RoleController@update'
]);

Route::get('admin-role-inactive/{id}',[
    'as' => 'admin.role.inactive',
    'uses' => 'RoleController@inactive'
]);

Route::get('admin-role-delete/{id}',[
    'as' => 'admin.role.delete',
    'uses' => 'RoleController@roleDelete'
]);




