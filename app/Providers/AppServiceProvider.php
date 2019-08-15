<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // provide view with sidebar info if available
        view()->composer('*', function ($view) {
            if (strpos($view->getName(), ':') !== false) {
                $namespace = strtok($view->getName(), ':');
            }

            if (isset($view->getData()['resource'])) {
                $namespace = $view->getData()['resource'];
            }

            if (isset($namespace) && view()->exists($namespace.'::sidebar')) {
                view()->share('sidebar', $namespace.'::sidebar');
            } else {
                view()->share('sidebar', false);
            }

            if (isset($namespace) && view()->exists($namespace.'::options')) {
                view()->share('options', $namespace.'::options');
            } else {
                view()->share('options', false);
            }
        });
    }
}
