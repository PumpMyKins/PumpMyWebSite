<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['dashboard', 'servers', 'infos']);
    }

    /**
     * Show the application api dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function api()
    {
        return view('panel.api');
    }

    /**
     * Show the application api dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('panel.api');
    }

    /**
     * Show the application servers dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function servers()
    {
        return view('panel.api');
    }

    /**
     * Show the application infos dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function infos()
    {
        return view('panel.api');
    }
}
