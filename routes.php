<?php
// User
Route::group(
    [
        'namespace' =>	'App\Modules\Accounts\Controllers',
        'prefix'	=>	'accounts',
    ],
    function()
    {
        Route::get('login',    ['as' => 'accounts.login', 'uses' => 'UserViewController@loginView']);
        Route::post('login',   ['as' => 'accounts.login', 'uses' => 'UserController@loginUser']);
        Route::get('register', ['as' => 'accounts.register', 'uses' => 'UserViewController@registerView']);
    }
);

// Special
