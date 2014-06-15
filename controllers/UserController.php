<?php namespace Modules\Accounts\Controllers;

use Ill\System\Base\BaseController;
use Modules\Accounts\Cases\Users\CreateUserRequest;
use Modules\Accounts\Cases\Users\ReadUserRequest;
use Modules\Accounts\Cases\Users\ReadAllUsersRequest;
use Illuminate\Support\Facades\Input;

class UserController extends BaseController
{

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

        $response = $this->bus->execute($request);

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
