<?php namespace Modules\Accounts\Cases\Users;

class ReadAllUsersResponse
{

    private $users;

    public function __construct($users)
    {

        $this->users = $users;

    }
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

}
