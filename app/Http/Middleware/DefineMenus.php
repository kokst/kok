<?php

namespace App\Http\Middleware;

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
        Menu::make('primary', function ($menu) {
            // $menu->add('Title', 'route');
        });

        return $next($request);
    }
}
