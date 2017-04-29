<?php

Route::group([
    'prefix'     => 'admin/users',
    'middleware' => ['admin', 'auth.admin'],
    'namespace'  => 'LaraMod\Admin\Users\Controllers',
], function () {
    Route::get('/', ['as' => 'admin.users', 'uses' => 'UsersController@index']);
    Route::get('/form', ['as' => 'admin.users.form', 'uses' => 'UsersController@getForm']);
    Route::post('/form', ['as' => 'admin.users.form', 'uses' => 'UsersController@postForm']);

    Route::get('/delete', ['as' => 'admin.users.delete', 'uses' => 'UsersController@delete']);
    Route::get('/datatable', ['as' => 'admin.users.datatable', 'uses' => 'UsersController@dataTable']);
});

Route::group([
    'prefix'     => 'admin/admins',
    'middleware' => ['admin', 'auth.admin'],
    'namespace'  => 'LaraMod\Admin\Users\Controllers',
], function () {
    Route::get('/', ['as' => 'admin.admins', 'uses' => 'AdminsController@index']);
    Route::get('/form', ['as' => 'admin.admins.form', 'uses' => 'AdminsController@getForm']);
    Route::post('/form', ['as' => 'admin.admins.form', 'uses' => 'AdminsController@postForm']);

    Route::get('/delete', ['as' => 'admin.admins.delete', 'uses' => 'AdminsController@delete']);
    Route::get('/datatable', ['as' => 'admin.admins.datatable', 'uses' => 'AdminsController@dataTable']);
});