<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;


class RolController extends Controller
{
    //
    public function index()
    {
        return Rol::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'NombreRol' => 'required|max:255'
        ]);
        Rol::create([
            'NombreRol'=>$request->NombreRol
        ]);       
        return response()->json("El rol se ha agregado con éxito", 200);
    }

    public function show($id)
    {
        return Rol::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'NombreRol' => 'required|max:255'
        ]);
        Rol::where('IdRol', $id)->update($request->all());
        return response()->json("El registro se ha actualizado con éxito", 200);
    }
}
