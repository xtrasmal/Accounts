<?php namespace Modules\Accounts\Cases\Tenants;

class SetupTenantForUserResponse
{

    public $tenant;

    public function __construct($tenant)
    {

        $this->tenant = $tenant;

    }

}
