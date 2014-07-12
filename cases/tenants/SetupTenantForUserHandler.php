<?php namespace Modules\Accounts\Cases\Tenants;

use Ill\Core\Events\Dispatcher;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Ill\System\Contexts\TenantRepository;
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


        return true;

    }

}
