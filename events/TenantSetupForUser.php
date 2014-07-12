<?php namespace Modules\Accounts\Events;

use Modules\Accounts\Models\Tenant;
use Ill\Core\Events\Interfaces\EventInterface;

class TenantSetupForUser implements EventInterface
{

    public $tenant;

    public function __construct(Tenant $tenant)
    {

        $this->tenant = $tenant;

    }

    public function getName()
    {

        return 'tenantSetupForUser';

    }

}
