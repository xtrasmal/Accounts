<?php
// User
Route::group(
    [
        'namespace' =>	'Modules\Accounts\Controllers',
        'prefix'	=>	'accounts',
    ],
    function()
    {
        Route::get('logout',         ['as' => 'accounts.logout', 'uses' => 'UserController@logoutUser']);
        Route::get('login',         ['as' => 'accounts.login', 'uses' => 'UserViewController@loginView']);
        Route::post('login',        ['as' => 'accounts.login', 'uses' => 'LoginFormController@loginUser']);
        Route::get('register',      ['as' => 'accounts.register', 'uses' => 'UserViewController@registerView']);
        Route::post('register',     ['as' => 'accounts.register', 'uses' => 'RegisterFormController@registerUser']);
        Route::get('forgot',        ['as' => 'accounts.forgot', 'uses' => 'UserViewController@forgotView']);
        Route::post('forgot',       ['as' => 'accounts.forgot', 'uses' => 'ForgotFormController@resetUser']);
        Route::get('reset/{token}', ['as' => 'accounts.reset.password', 'uses' => 'UserViewController@resetView']);
        Route::post('reset',        ['as' => 'accounts.reset.password', 'uses' => 'ResetFormController@resetPassword']);
        Route::get('{id}',          ['as' => 'accounts.show', 'uses' => 'UserController@readUser']);
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
        Route::get('/', ['as'=>'accounts.all', 'uses'=>'UserViewController@allUsersView']);
    }
);
// Special
