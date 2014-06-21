<?php namespace Modules\Accounts;

use Modules\Account\Models\User,
    Illuminate\Foundation\AliasLoader,
    Illuminate\Support\ServiceProvider,
    Modules\Accounts\Repositories\EloquentUserRepository;

class AccountsServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['user'] = $this->app->share(function($app)
        {
            return new User;
        });

        $this->app->booting(function()
        {
            $loader = AliasLoader::getInstance();
            $loader->alias('User', 'Modules\Accounts\Models\User');
        });

//        $this->app->bind('Modules\Accounts\Repositories\UserRepository', function()
//        {
//            return new EloquentUserRepository(new User);
//        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('user');
    }

}
