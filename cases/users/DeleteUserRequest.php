<?php namespace Modules\Accounts\Cases\Users;

class DeleteUserRequest
{

    public $id;

    public function __construct($id)
    {

        $this->id    = $id;

    }

}
