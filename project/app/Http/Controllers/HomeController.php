<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($id, $sid)
    {
        return view('home', ['id' => $id, 'sid' => $sid]);
    }
    public function page($id, $sid)
    {
        return view('page', ['id' => $id, 'sid' => $sid]);
    }
    public function slavePage($id, $sid)
    {
        return view('slavePage', ['id' => $id, 'sid' => $sid]);
    }
}
