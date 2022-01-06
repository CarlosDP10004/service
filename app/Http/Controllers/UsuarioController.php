<?php

namespace App\Http\Controllers;
use App\User;
use App\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //


    public function store(Request $request)
    {
        $this->validate($request, [
            'NombreUsuario' => 'required|string|max:255|unique:Usuario',
            'Contrasenna' => 'required|string|min:8'
        ]);

        $user = User::create([
            'NombreUsuario'=>$request->NombreUsuario,
            'Contrasenna'=>$request->Contrasenna,
            'Estado' => 1,
            'Intento' => 0,
        ]);
        $user->save();
        $roles = $request->get('Roles');
        $user->roles()->sync($roles);        
        
        return response()->json("El usuario se ha agregado con éxito", 200);
    }

}
