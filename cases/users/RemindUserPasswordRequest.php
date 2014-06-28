<?php namespace Modules\Accounts\Cases\Users;

class RemindUserPasswordRequest
{

    public $email;

    public function __construct($email)
    {

        $this->email    = $email;

    }

}
