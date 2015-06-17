<?php namespace JasonXt\UmengLaravel;

use Illuminate\Support\ServiceProvider;

class UmengLaravelServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('jason-xt/umeng-laravel');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bindShared('umeng.pusher', function ($app) {
            return new Pusher($app['config']['umeng-laravel::appKey'], $app['config']['umeng-laravel::appSecret']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('umeng.pusher');
    }

}
