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

        //DB::table('runs')->join('run_user', 'run_user.run_id', '=', 'runs.id')->where('run_user.user_id', '=', '2')->get();


        $mascotas = DB::table('mascotas')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->get();


        $data = array(

            //'mascotas' => DB::table('mascotas')->take(25)->get(),
            'animales' => DB::table('animal')->get(),
            'razas' => DB::table('razas')->get(),
            'mascotas' => $mascotas

        );
        return view('home')->with($data);
    }
}
