<?php namespace Modules\Accounts\Cases\Tenants;

class ConnectTenantToUserResponse
{

    public $user;

    public function __construct($user)
    {

        $this->user = $user;

    }

}
