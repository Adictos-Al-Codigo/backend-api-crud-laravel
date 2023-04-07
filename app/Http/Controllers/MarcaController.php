<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::where('estado',1)->get();
        return response()->json($marcas,200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $marca = Marca::create([
            'nombre' => $validData['nombre'],
            'estado' => 1
        ]);

        return response()->json(['message' => 'Marca Registrada'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = Marca::find($id);

        if (is_null($marca)) {
            return response()->json(['message'=> 'La Marca NO Existe'],404);
        }
        return response()->json($marca,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $marca = Marca::find($id);

        if(is_null($marca)){
            return response()->json(['message' => 'La Marca No Existe']);
        }

        $validData = $request->validate([
            'nombre' => 'required'
        ]);

        $marca->nombre = $validData['nombre'];
        $marca->save();

        return response()->json(['message' => 'Marca Actualizada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /* $marca = Marca::destroy($id); */
        $marca = Marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'La Marca No Existe']);
        }

        $marca->estado=0;
        $marca->save();

        return response()->json(['message' => 'La Marca ha sido Borrada']);
    }
}
