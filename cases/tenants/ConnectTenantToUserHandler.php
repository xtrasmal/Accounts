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

        $this->dispatch($user);

        return $this->respond($user);

    }

    public function dispatch($entity)
    {
        $entity->connectTenant($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    public function respond($response)
    {
        return new ConnectTenantToUserResponse($response);
    }
}
