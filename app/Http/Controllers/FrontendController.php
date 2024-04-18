<?php

namespace App\Http\Controllers;

use App\Modules\Configuration\ConfigurationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;
use DB;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function HomePage(){
        ConfigurationHelper::Language();
        $TabHeader = 'Home';
        return view("frontend.layouts.welcome",compact('TabHeader'));
    }


}
