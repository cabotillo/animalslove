<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provincias;
class ProvinciasController extends Controller
{
    //
    public function index()
    {
        $provincias = Provincias::all();

        return view('auth.register',compact('provincias'));
    }
}