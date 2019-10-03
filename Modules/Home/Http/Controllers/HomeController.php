<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the index view of the module.
     * @return View
     */
    public function index()
    {
        return view('home::index');
    }
}
