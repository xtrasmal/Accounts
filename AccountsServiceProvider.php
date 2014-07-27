<?php namespace Modules\Accounts;

use Modules\Accounts\Listeners\ConnectTenantToUser;
use Modules\Accounts\Models\User,
    Illuminate\Foundation\AliasLoader,
    Illuminate\Support\ServiceProvider,
    Ill\System\Contexts\TenantContext,
    Modules\Accounts\Listeners\SetupTenantForUser;

class AccountsServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Ill\System\Contexts\Context', function($app)
        {
            return $app['context'];
        });
        $this->app['context'] = $this->app->share(function($app)
        {
            return new TenantContext;
        });

        $this->app['user'] = $this->app->share(function($app)
        {
            return new User;
        });
        $this->app->bind(
            'Modules\Accounts\Repositories\UserRepository',
            'Modules\Accounts\Repositories\EloquentUserRepository'
        );
        $this->app->booting(function()
        {
            $loader = AliasLoader::getInstance();
            $loader->alias('User', 'Modules\Accounts\Models\User');
        });

    }

    public function boot()
    {

        $dispatcher = $this->app->make('Ill\Core\Events\Dispatcher');
        $bus = $this->app->make('Ill\Core\CommandBus\DefaultCommandBus');
        $events = $this->getModuleEvents($bus);

        foreach($events as $eventName=>$eventListeners)
        {
            $dispatcher->addListener($eventName, $eventListeners);
        }

    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('user','context');
    }

    private function getModuleEvents($bus)
    {

        return [
            'User.Registered'     =>  new SetupTenantForUser($bus),
            'Tenant.Set.For.User' =>  new ConnectTenantToUser($bus)
        ];
    }

}
