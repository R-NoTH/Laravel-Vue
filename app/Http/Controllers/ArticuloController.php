<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloRequest;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Articulo::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloRequest $request)
    {
        $articulo = new Articulo();
        $articulo->create($request->all());
        $data = json_decode($request->getContent());
        $name = $data->name;
        $description = $data->description;
        $stock = $data->stock;
        $option = $data->option;

        return response()->json($option);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        return $articulo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloRequest $request, Articulo $articulo)
    {
        $articulo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
    }
}
