<?php namespace Modules\Accounts\Cases\Tenants;

use Ill\Core\Events\Dispatcher;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Models\Tenant;

class SetupTenantForUserHandler implements HandlerInterface
{

    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {

        $this->dispatcher = $dispatcher;

    }

    public function handle($command)
    {

        $tenant = Tenant::register($command->user->id);

        $tenant->save();
        $tenant->users()->attach($command->user->id);
        $command->user->tenant_id = $tenant->id;

        $this->dispatch($command->user);
        return $this->respond($command->user);

    }

    public function dispatch($entity)
    {
        $tenant = new Tenant();
        $tenant->TenantSetForUser($entity);
        $this->dispatcher->dispatch($tenant->releaseEvents());
    }

    public function respond($response)
    {

        return new SetupTenantForUserResponse($response);
    }
}
