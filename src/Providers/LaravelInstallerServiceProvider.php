<?php

namespace Coderstm\LaravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Coderstm\LaravelInstaller\Middleware\CanInstall;
use Coderstm\LaravelInstaller\Middleware\CanUpdate;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->registerPublishing();
        $this->registerResources();
        $this->loadRoutesFrom($this->packagePath('routes/web.php'));
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath('config/installer.php') => base_path('config/installer.php'),
            ], 'installer-config');

            $this->publishes([
                $this->packagePath('public') => public_path('installer'),
            ], 'installer-assets');

            $this->publishes([
                $this->packagePath('resources/views') => base_path('resources/views/vendor/installer'),
            ], 'installer-views');

            $this->publishes([
                $this->packagePath('resources/lang') => base_path('resources/lang/vendor/installer'),
            ], 'installer-lang');
        }
    }

    /**
     * Setup the configuration for Coderstm.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/installer.php'),
            'installer'
        );
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom($this->packagePath('resources/views'), 'installer');
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'installer');
    }

    protected function packagePath(string $path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
