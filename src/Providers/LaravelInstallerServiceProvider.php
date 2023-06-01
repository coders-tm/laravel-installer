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
        $this->publishFiles();
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
    protected function publishFiles()
    {
        $this->publishes([
            $this->packagePath('config/installer.php') => base_path('config/installer.php'),
        ], 'laravelinstaller-config');

        $this->publishes([
            $this->packagePath('public') => public_path('installer'),
        ], 'laravelinstaller-public');

        $this->publishes([
            $this->packagePath('views') => base_path('resources/views/vendor/installer'),
        ], 'laravelinstaller-views');

        $this->publishes([
            $this->packagePath('lang') => base_path('resources/lang'),
        ], 'laravelinstaller-lang');
    }

    protected function packagePath(string $path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
