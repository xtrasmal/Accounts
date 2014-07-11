<?php namespace Modules\Accounts\Cases\Tenants;

use Ill\Core\Events\Dispatcher;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Models\Account;

class SetupTenantForUserHandler implements HandlerInterface
{

    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {

        $this->dispatcher = $dispatcher;

    }

    public function handle($command)
    {

        $tenant = Account::register();
        $tenant->save();

        $command->user->account_id = $tenant->id;
        $command->user->save();

        return true;

    }

}
