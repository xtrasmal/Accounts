<?php namespace App\Modules\Accounts\Cases\Users;

class ReadUserRequest
{

    public $id;

    public function __construct($id)
    {

        $this->id    = $id;

    }

}
