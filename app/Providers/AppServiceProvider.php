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
            $view = $view->getName();
            if (strpos($view, ':') !== false) {
                $namespace = strtok($view, ':');

                if (view()->exists($namespace.'::sidebar')) {
                    view()->share('sidebar', $namespace.'::sidebar');
                } else {
                    view()->share('sidebar', false);
                }
            }
        });
    }
}
