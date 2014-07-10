<?php namespace Modules\Accounts\Listeners;

use Ill\Core\Events\Interfaces\ListenerInterface;
use Ill\Core\Events\Interfaces\EventInterface;
use Modules\Accounts\Cases\Tenants\SetupTenantForUserRequest;

class SetupTenantForUser implements ListenerInterface
{

    public function handle(EventInterface $event)
    {

        $request = new SetupTenantForUserRequest($event->user);


    }

}
