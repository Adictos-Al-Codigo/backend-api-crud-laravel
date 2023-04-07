<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = Categoria::where('estado',1)->get();
        return response()->json($categoria,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valiData = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $categoria = Categoria::create([
            'nombre' => $valiData['nombre'],
            'estado' => 1
        ]);

        return response()->json(['message'=>'Categoria Registrada Correctamente.',200]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return response()->json(['message'=>'Categoria no encontrada',404]);
        }

        return response()->json([$categoria,'message'=>'Categoria Encontrada',200]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria no Encontrada',404]);
        }

        $validData = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $categoria->nombre = $validData['nombre'];
        $categoria->estado = 1;

        return response()->json([$categoria,'message' => 'Categoria Actualizada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria No Encontrada',404]);
        }

        $categoria->estado = 0;
        $categoria->save();

        return response()->json(['message' => 'Categoria Eliminada',200]);
    }
}
