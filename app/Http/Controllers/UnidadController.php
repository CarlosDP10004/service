<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unidad;

class UnidadController extends Controller
{
    public function index(Request $request)
    {
        //
        /*if(UsuarioController::validatepermissions($request, 'Unidades', 'Ver Lista')){
            return Unidad::all();
        }
        return response()->json("El usuario no tiene los permisos", 401);*/
        return Unidad::all();
    }


    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'NombreUnidad' => 'required|string|max:255|unique:Unidad',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Unidades', 'Agregar')){
            Unidad::create([
            'NombreUnidad'=>$request->NombreUnidad,
            'IdUsuario'=>$request->IdUsuario,
            ]);
            return response()->json("La unidad se ha agregado con éxito", 200);
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        Unidad::create([
            'NombreUnidad'=>$request->NombreUnidad,
            'IdUsuario'=>$request->IdUsuario,
        ]);
        return response()->json("La unidad se ha agregado con éxito", 200);

    }


    public function show(Request $request, $id)
    {
        //
        /*
        if(UsuarioController::validatepermissions($request, 'Unidades', 'Ver Detalle')){
            if(Unidad::where('IdUnidad', $id)->exists()){
            $unidad = Unidad::findOrFail($id);
            $unidad->encargado;
            return $unidad;
            }else{
                return response()->json("El rol no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        if(Unidad::where('IdUnidad', $id)->exists()){
            $unidad = Unidad::findOrFail($id);
            $unidad->encargado;
            return $unidad;
        }else{
            return response()->json("El rol no se ha encontrado", 404);
        }
    }



    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'NombreUnidad' => 'required|string|max:255|unique:Unidad',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Unidades', 'Editar')){
            if(Unidad::where('IdUnidad', $id)->exists()){
            Unidad::where('IdUnidad', $id)->update(array('NombreUnidad' => $request['NombreUnidad'], 
            'IdUsuario' => $request['IdUsuario']));
            return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("El rol no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        
        if(Unidad::where('IdUnidad', $id)->exists()){
            Unidad::where('IdUnidad', $id)->update(array('NombreUnidad' => $request['NombreUnidad'], 
            'IdUsuario' => $request['IdUsuario']));
            return response()->json("El registro se ha actualizado con éxito", 200);
        }else{
            return response()->json("El rol no se ha encontrado", 404);
        }

    }


}
