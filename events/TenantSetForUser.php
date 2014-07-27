<?php namespace Modules\Accounts\Events;

use Modules\Accounts\Models\User;
use Ill\Core\Events\Interfaces\EventInterface;

class TenantSetForUser implements EventInterface
{

    public $userid;
    public $tenantid;

    public function __construct(User $user)
    {


        $this->userid = $user->id;
        $this->tenantid = $user->tenant_id;
    }

    public function getName()
    {

        return 'Tenant.Set.For.User';

    }

}
