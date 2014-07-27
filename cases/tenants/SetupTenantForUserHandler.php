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

        $tenant->TenantSetForUser($command->user);

        $this->dispatcher->dispatch($tenant->releaseEvents());

        return new SetupTenantForUserResponse($tenant);

    }

}
