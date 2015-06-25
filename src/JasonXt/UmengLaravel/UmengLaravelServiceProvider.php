<?php namespace JasonXt\UmengLaravel;

use Illuminate\Support\ServiceProvider;
use JasonXt\UmengLaravel\Android\AndroidPusher;
use JasonXt\UmengLaravel\IOS\IOSPusher;

class UmengLaravelServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        $this->app->bindShared('umeng.ios', function ($app) {
            return new IOSPusher($app['config']['umeng-laravel::ios_appKey'], $app['config']['umeng-laravel::ios_app_master_secret']);
        });
        $this->app->bindShared('umeng.android', function ($app) {
            return new AndroidPusher($app['config']['umeng-laravel::android_appKey'], $app['config']['umeng-laravel::android_app_master_secret']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('umeng.ios','umeng.android');
    }

}
