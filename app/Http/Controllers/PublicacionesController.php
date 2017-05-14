<?php

namespace App\Http\Controllers;

use App\Publicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publicaciones  $publicaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Publicaciones $publicaciones)
    {
        //

        //dd($publicaciones);
        DB::connection('mysql')->getDatabaseName();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publicaciones  $publicaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicaciones $publicaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publicaciones  $publicaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicaciones $publicaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publicaciones  $publicaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicaciones $publicaciones)
    {
        //
    }
}
