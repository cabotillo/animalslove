<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('admin')->except('logout');
    }

    public function index(){

        $usuarios = User::all();
        $data =array(
            'usuarios' => $usuarios,

        );

        return view('admin')->with($data);
    }
}
