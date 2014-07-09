<?php namespace Modules\Accounts\Listeners;

use Ill\Core\CommandBus\DefaultCommandBus;
use Ill\Core\Events\Interfaces\ListenerInterface;
use Ill\Core\Events\Interfaces\EventInterface;
use Modules\Accounts\Cases\Tenants\SetupTenantForUserRequest;

class SetupTenantForUser implements ListenerInterface
{

    protected $user;
    private $bus;

    public function __construct($user, DefaultCommandBus $bus = null)
    {
        $this->user = $user;
        $this->bus = $bus;
    }

    public function handle(EventInterface $event)
    {

        $request = new SetupTenantForUserRequest($this->user);
        $this->bus->execute($request);

    }

}
