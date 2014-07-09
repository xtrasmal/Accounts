<?php namespace Modules\Accounts\Cases\Tenants;

class SetupTenantForUserRequest
{

    public $user;

    public function __construct($user)
    {
        $this->user = $user;

    }

}
