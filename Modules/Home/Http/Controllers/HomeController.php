<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;

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
