<?php namespace Modules\Accounts\Listeners;

use Ill\Core\CommandBus\DefaultCommandBus, App;
use Ill\Core\Events\Interfaces\ListenerInterface;
use Ill\Core\Events\Interfaces\EventInterface;
use Modules\Accounts\Cases\Tenants\ConnectTenantToUserRequest;

class ConnectTenantToUser implements ListenerInterface
{

    private $bus;

    public function __construct(DefaultCommandBus $bus)
    {

        $this->bus = $bus;

    }

    public function handle(EventInterface $event)
    {

        $request = new ConnectTenantToUserRequest($event);
        $this->bus->execute($request);


    }

}
