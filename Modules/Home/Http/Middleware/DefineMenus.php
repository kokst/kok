<?php

namespace Modules\Home\Http\Middleware;

use Closure;
use Lavary\Menu\Facade as Menu;

class DefineMenus
{
    public function handle($request, Closure $next): object
    {
        $menu = Menu::get('primary') ?? Menu::make('primary', function () {
        });

        $menu->add(strval(__('home::index.title')), ['action'   => '\Modules\Home\Http\Controllers\HomeController@index']);

        return $next($request);
    }
}
