<?php namespace Modules\Accounts\Cases\Tenants;

use Ill\Core\Events\Dispatcher;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class SetupTenantForUserHandler implements HandlerInterface
{

    private $tenant;
    private $dispatcher;

    public function __construct(Tenant $tenant,
                                Dispatcher $dispatcher)
    {

        $this->tenant = $tenant;
        $this->dispatcher = $dispatcher;

    }

    public function handle($command)
    {
        $this->tenant->save($command->user);
        return true;

    }

}
