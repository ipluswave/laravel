<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageName = $_SERVER['REQUEST_URI'];
        return view('home', ['pageName' => $pageName]);
    }

    public function storeScreenWidth(){
        $screenWidth = $_REQUEST['screenwidth'];
        Session::put('screenWidth', $screenWidth);
        return;
    }
}
