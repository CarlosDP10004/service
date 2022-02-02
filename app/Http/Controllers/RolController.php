<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Permiso;


class RolController extends Controller
{
    //
    public function index(Request $request)
    {
        if(UsuarioController::validatepermissions($request, 'Roles', 'Ver Lista')){
            return Rol::all();
        }
        return response()->json("Acceso denegado", 401);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'NombreRol' => 'required|string|max:255|unique:Rol',
        ]);

        if(UsuarioController::validatepermissions($request, 'Roles', 'Agregar')){
            $rol = Rol::create([
                'NombreRol'=>$request->NombreRol,
            ]);
            $rol->save();
            $permisos = $request->get('Permisos');
            $rol->permisos()->sync($permisos);
            return response()->json("El rol se ha agregado con éxito", 200);
        }
        return response()->json("El usuario no tiene los permisos", 401);
    }

    public function show(Request $request, $id)
    {
        if(UsuarioController::validatepermissions($request, 'Roles', 'Ver Detalle')){
            if(Rol::where('IdRol', $id)->exists()){
                $rol = Rol::findOrFail($id);
                $rol->permisos;
                return $rol;
            }else{
                return response()->json("El rol no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'NombreRol' => 'required|max:255'
        ]);
        if(UsuarioController::validatepermissions($request, 'Roles', 'Editar')){
            if(Rol::where('IdRol', $id)->exists()){
                Rol::where('IdRol', $id)->update(array('NombreRol' => $request['NombreRol']));
                Rol::find($id)->permisos()->sync($request['Permisos']);               
                return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("El rol no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
    }

    public function permissions(){
        return Permiso::all();
    }
}
