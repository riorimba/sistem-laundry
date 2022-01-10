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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('member/home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function register()
    {
        return view('register');
    }

    public function outlet()
    {
        return view('outlet');
    }
    public function paket()
    {
        return view('paket');
    }
    public function user()
    {
        return view('user');
    }
    public function laporan()
    {
        return view('laporan');
    }
}
