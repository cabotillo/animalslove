<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = array(

            'mascotas' => DB::table('mascotas')->take(25)->get(),
            'animales' => DB::table('animal')->get(),
            'razas' => DB::table('razas')->get(),

        );
        return view('home')->with($data);
    }
}
