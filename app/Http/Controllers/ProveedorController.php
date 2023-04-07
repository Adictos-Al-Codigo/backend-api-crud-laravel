<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedor = Proveedor::where('estado',1)->get();
        return response()->json([$proveedor,'message' => 'Proveedores Encontrados',200]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
        ]);

        $proveedor = new Proveedor([
            'nombre' => $validData['nombre'],
            'apellido' => $validData['apellido'],
            'cedula' => $validData['cedula'],
            'estado' => 1
        ]);

        $proveedor->save();

        return response()->json([$proveedor,'message' => 'Proveedor Registrado']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);

        if (is_null($proveedor)) {
            return response()->json(['message'=>'Proveedor No Encontrado.',404]);
        }

        return response()->json([$proveedor,'message' => 'Proveedor Encontrado',200]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $proveedor = Proveedor::find($id);

        if (is_null($proveedor)) {
            return response()->json(['message' => 'Proveedor No Encontrado.',404]);
        }

        $validData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required'
        ]);

        $proveedor->nombre = $validData['nombre'];
        $proveedor->apellido = $validData['apellido'];
        $proveedor->cedula = $validData['cedula'];
        $proveedor->estado = 1;
        $proveedor->save();

        return response()->json([$proveedor,'message' => 'Proveedor Actualizado.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        if (is_null($proveedor)) {
            return response()->json(['message' => 'Proveedor No Encontrado.',404]);
        }

        $proveedor->estado = 0;
        $proveedor->save();

        return response()->json(['message' => 'Proveedor Eliminado']);
    }
}
