<?php namespace App\Modules\Accounts\Cases\Users;

class DeleteUserCommand
{

    public $id;

    public function __construct($id)
    {

        $this->id    = $id;

    }

}
