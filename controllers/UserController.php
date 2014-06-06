<?php namespace App\Modules\Accounts\Controllers;

use Ill\System\Base\BaseController;
use App\Modules\Accounts\Cases\Users\CreateUserCommand;
use Illuminate\Support\Facades\Input;

class UserController extends BaseController
{

    public function createUser()
    {
        $command = new CreateUserCommand(
            Input::get('email'),
            Input::get('name'),
            Hash::make(Input::get('password'))
        );

        $this->bus->execute($command);

        return $this->redirectAction('UserViewController@allUsersView');

    }

    public function readUser($id)
    {
        $command = new ReadUserRequest($id);

        $this->bus->execute($command);

        // return Redirect::action('TicketController@getViewTicket');

    }
}
