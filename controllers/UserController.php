<?php namespace App\Modules\Accounts\Controllers;

use App\Modules\Accounts\Cases\Users\LoginUserRequest;
use Ill\System\Base\BaseController;
use App\Modules\Accounts\Cases\Users\CreateUserRequest;
use Illuminate\Support\Facades\Input;

class UserController extends BaseController
{

    public function loginUser()
    {

        $command = new LoginUserRequest(
            Input::get('email'),
            Input::get('password')
        );
        $this->bus->execute($command);

        return $this->redirectRoute('accounts.register');

    }

    public function createUser()
    {
        $command = new CreateUserRequest(
            Input::get('email'),
            Input::get('name'),
            Hash::make(Input::get('password'))
        );

        $this->bus->execute($command);

        return $this->redirectAction('UserViewController@allUsersView');

    }

    public function readUser($id)
    {
        $request = new ReadUserRequest($id);

        $this->bus->execute($request);

        return $this->redirectAction('UserViewController@singleUserView');

    }

    public function readAllUsers()
    {
        $request = new ReadAllUsersRequest();

        $this->bus->execute($request);

        return $this->redirectAction('UserViewController@allUsersView');

    }

    public function deleteUser($id)
    {
        $command = new DeleteUserRequest($id);

        $this->bus->execute($command);

        return $this->redirectAction('UserViewController@allUsersView');

    }

}
