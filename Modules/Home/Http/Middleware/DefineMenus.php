<?php

namespace Modules\Home\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lavary\Menu\Facade as Menu;

class DefineMenus
{
    /**
     * @return RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next)
    {
        $menu = Menu::get('primary') ?? Menu::make('primary', function () {
        });

        $menu->add(strval(__('home::index.title')), ['action' => '\Modules\Home\Http\Controllers\HomeController@index']);

        return $next($request);
    }
}
