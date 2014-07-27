<?php
// User
Route::group(
    [
        'namespace' =>	'Modules\Accounts\Controllers',
        'prefix'	=>	'accounts',
    ],
    function()
    {
        Route::get('logout',        ['as' => 'accounts.logout', 'uses' => 'UserController@logoutUser']);
        Route::get('login',         ['as' => 'accounts.login', 'uses' => 'UserViewController@loginView']);
        Route::get('register',      ['as' => 'accounts.register', 'uses' => 'UserViewController@registerView']);
        Route::get('forgot',        ['as' => 'accounts.forgot', 'uses' => 'UserViewController@forgotView']);
        Route::get('reset/{token}', ['as' => 'accounts.reset.password', 'uses' => 'UserViewController@resetView']);
    }
);
// CSRF
Route::group(
    [
        'namespace' =>	'Modules\Accounts\Controllers',
        'prefix'	=>	'accounts',
        'before'    =>  'csrf',
    ],
    function()
    {
        Route::post('login',        ['as' => 'accounts.login', 'uses' => 'LoginFormController@loginUser']);
        Route::post('register',     ['as' => 'accounts.register', 'uses' => 'RegisterFormController@registerUser']);
        Route::post('forgot',       ['as' => 'accounts.forgot', 'uses' => 'ForgotFormController@resetUser']);
        Route::post('reset',        ['as' => 'accounts.reset.password', 'uses' => 'ResetFormController@resetPassword']);

    }
);
// Admin
Route::group(
    [
        'namespace' => 'Modules\Accounts\Controllers',
        'prefix'    => 'accounts',
        'before'    => 'auth',
    ],
    function()
    {
        Route::get('/',             ['as'=>'accounts.all',      'uses'=>'UserViewController@allUsersView']);
        Route::get('create',        ['as'=>'accounts.create',   'uses'=>'UserViewController@createUserView']);
        Route::post('create',       ['as'=>'accounts.create',   'uses'=>'CreateUserFormController@createUser']);
    }
);

// Special
