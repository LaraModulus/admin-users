<?php

Route::group([
    'prefix' => 'admin/users',
    'middleware' => ['web', 'auth'],
    'namespace' => 'LaraMod\Admin\Users',
], function(){
    Route::get('/', ['as' => 'admin.users', 'uses' => 'AdminUsersController@index']);
    Route::get('/form', ['as' => 'admin.users.form', 'uses' => 'AdminUsersController@getForm']);
    Route::post('/form', ['as' => 'admin.users.form', 'uses' => 'AdminUsersController@postForm']);

    Route::get('/delete', ['as' => 'admin.users.delete', 'uses' => 'AdminUsersController@delete']);
});
