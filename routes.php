<?php
// User
Route::group(
    [
        'namespace' =>	'Modules\Accounts\Controllers',
        'prefix'	=>	'accounts',
    ],
    function()
    {
        Route::get('login',    ['as' => 'accounts.login', 'uses' => 'UserViewController@loginView']);
        Route::post('login',   ['as' => 'accounts.login', 'uses' => 'LoginFormController@loginUser']);
        Route::get('register', ['as' => 'accounts.register', 'uses' => 'UserViewController@registerView']);
        Route::post('register',['as' => 'accounts.register', 'uses' => 'RegisterFormController@registerUser']);
        Route::get('{id}',    ['as' => 'accounts.show', 'uses' => 'UserController@readUser']);
    }
);

// Special
