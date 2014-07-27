<?php namespace Modules\Accounts\Cases\Tenants;

class ConnectTenantToUserRequest
{

    public $user;

    public function __construct($user)
    {

        $this->user = $user;

    }

}
