<?php

namespace App\Http\Controllers;

use App\Models\Tipo_usuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales Inválidas'], 401);
        }

        $usuario = User::where('email', $request->email)->first();

        $token = $usuario->createToken('auth_token')->plainTextToken;

        $res = DB::table('users')
        ->join('tipo_usuarios', 'users.id_tipo_usuario', '=', 'tipo_usuarios.id')
        ->select('users.*', 'tipo_usuarios.*')
        ->where('users.email', $usuario->email)
        ->get();

        return response()->json(
            [

                'accesToken' => $token,
                'tokenType' => 'Bearer',
                'typeUserId' => $usuario->id_tipo_usuario,
                'id' => $usuario->id,
                'userName' => $usuario->name,
                'email' => $usuario->email,
                'rol' => $res[0]->tipo,
                'status' => "ok",
                'message' => "Credenciales Válidas"
            ], 200

        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = DB::table('users')
        ->join('tipo_usuarios','users.id_tipo_usuario','=',"tipo_usuarios.id")
        ->select('users.id','users.url_imagen','users.email','users.password','users.estado','tipo_usuarios.tipo as tipo')->where('users.estado',1)->get();
        return response()->json($user,202);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'url_imagen' => 'required',
            'name' => 'required', 
            'email' => 'required',
            'password' => 'required',
            'id_tipo_usuario' => 'required'
        ]);

        $img = $request->file('url_imagen');
        $validData['url_imagen'] = time().'.'.$img->getClientOriginalExtension();

        $user = new User([
            'url_imagen' => $validData['url_imagen'],
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => Hash::make( $validData['password']),
            'id_tipo_usuario' => $validData['id_tipo_usuario'],
            'estado' => 1
        ]);

        $user->save();
        $request->file('url_imagen')->storeAs("public/imagenes/usuarios/{$user->id}",$validData['url_imagen']);
        return response()->json($user,200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $user = User::find($id);


        if (is_null($user)) {
            return response()->json(['message' => 'Usuario No Enocntrado.',404]);
        }

        return response()->json([$user,'message' => 'Usuario Encontrado.',200]);
    }

    public function show_type_user(){
        $type_user = Tipo_usuario::where('estado',1)->get();
        return response()->json($type_user,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Usuario No Encontrado',404]);
        }

        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message'  => 'Usuario No Encontrado.',404]);
        }

        $validData = $request->validate([
            'name' => 'required', 
            'email' => 'required',
            'id_tipo_usuario' => 'required'
        ]);


        $user->name = $validData['name'];
        $user->email = $validData['email'];
        $user->id_tipo_usuario = $validData['id_tipo_usuario'];
        $user->estado = 1;
        $user->save();

        return response()->json([$user,'message' => 'Usuario Actualizado.',200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Usuario No Encontrado.']);
        }

        $user->estado = 0;
        $user->save();

        return response()->json([$user,'message' => 'Usuario Eliminado.']);
    }
}
