<?php

Route::get('admin-organization-create', [
    'as' => 'admin.organization.create',
    'uses' => 'OrganizationController@create'
]);

Route::get('admin-organization-createlv', [
    'as' => 'admin.organization.createlv',
    'uses' => 'OrganizationController@createlv'
]);


Route::get('admin-organization-index', [
    'as' => 'admin.organization.index',
    'uses' => 'OrganizationController@index'
]);

Route::post('admin-organization-store',[
    'as' => 'admin.organization.store',
    'uses' => 'OrganizationController@store'
]);

Route::get('admin-organization-edit/{id}',[
    'as' => 'admin.organization.edit',
    'uses' => 'OrganizationController@edit'
]);

Route::PATCH('admin-organization-update/{id}',[
    'as' => 'admin.organization.update',
    'uses' => 'OrganizationController@update'
]);

Route::get('admin-organization-inactive/{id}',[
    'as' => 'admin.organization.inactive',
    'uses' => 'OrganizationController@inactive'
]);

Route::get('admin-organization-delete/{id}',[
    'as' => 'admin.organization.delete',
    'uses' => 'OrganizationController@delete'
]);




