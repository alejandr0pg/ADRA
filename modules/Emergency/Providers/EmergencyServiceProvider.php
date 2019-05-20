<?php
namespace Modules\Emergency\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\AliasLoader;

class EmergencyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerConfig();
        $this->registerAliases();
        $this->registerFactories();
        $this->registerTranslations();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        // Register the services providers
        foreach($this->provides() as $provider) {
            //
            $this->app->register($provider);
        }
    }

    public function registerAliases()
    {
        $loader = AliasLoader::getInstance();

        foreach($this->aliases() as $key => $class) {
            $loader->alias($key, $class);
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('emergency.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'emergency'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/emergency');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/emergency';
        }, \Config::get('view.paths')), [$sourcePath]), 'emergency');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/emergency');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'emergency');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'emergency');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            \Barryvdh\DomPDF\ServiceProvider::class,
        ];
    }

    public function aliases()
    {
        return [
            'PDF' => \Barryvdh\DomPDF\Facade::class,
        ];
    }
}
