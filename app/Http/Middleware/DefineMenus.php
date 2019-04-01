<?php

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Facade as Menu;

class DefineMenus
{
    public function handle($request, Closure $next)
    {
        Menu::make('primary', function ($menu) {

            // $menu->add('Title', 'route');

        });

        return $next($request);
    }
}
