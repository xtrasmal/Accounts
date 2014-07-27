<?php namespace Modules\Accounts\Cases\Tenants;

use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Cases\Users\BaseUserHandler;

class ConnectTenantToUserHandler extends BaseUserHandler implements HandlerInterface
{


    public function handle($command)
    {

        $user = $this->repo->find($command->user->userid);
        $user->tenant_id = $command->user->tenantid;
        $user->save();

        $user->connectTenant($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new ConnectTenantToUserResponse($user);

    }

}
