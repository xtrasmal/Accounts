<?php namespace Modules\Accounts;

use Illuminate\Support\ServiceProvider,
    Illuminate\Foundation\AliasLoader;

class AccountsServiceProvider extends ServiceProvider {

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
            $loader->alias('User', 'App\Modules\Accounts\Models\User');
        });


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
