<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AppController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.vue');
    }
}
