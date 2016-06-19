<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
    public function index()
    {
        return view('home');
    }

    /**
     * Show the task list.
     *
     * @return \Illuminate\Http\Response
     */
    public function tasks()
    {
        return view('tasks');
    }

    /**
     * Show the paging list.
     *
     * @return \Illuminate\Http\Response
     */
    public function paging()
    {
        return view('paging');
    }
}
