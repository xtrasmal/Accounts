<?php namespace Modules\Accounts\Controllers;

use Ill\System\Base\BaseController, View;

class UserViewController extends BaseController
{

    public function loginView()
    {

        return View::make('accounts.login');

    }

    public function registerView()
    {

        return View::make('accounts.register');

    }

    public function forgotView()
    {

        return View::make('accounts.forgot');

    }

    public function allUsersView()
    {

        // echo 'henk';

    }

    public function singleUserView()
    {

        echo 'henk';

    }
}
