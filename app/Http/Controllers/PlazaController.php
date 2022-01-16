<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plaza;

class PlazaController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        /*if(UsuarioController::validatepermissions($request, 'Plazas', 'Ver Lista')){
            return Plaza::all();
        }
        return response()->json("El usuario no tiene los permisos", 401);*/
        return Plaza::all();
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'NombrePlaza' => 'required|string|max:255|unique:Plaza',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Agregar')){
            Plaza::create([
            'NombrePlaza'=>$request->NombrePlaza,
            'IdUnidad'=>$request->IdUnidad,
            ]);
            return response()->json("La plaza se ha agregado con éxito", 200);
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        Plaza::create([
            'NombrePlaza'=>$request->NombrePlaza,
            'IdUnidad'=>$request->IdUnidad,
        ]);
        return response()->json("La plaza se ha agregado con éxito", 200);
    }

    public function show(Request $request, $id)
    {
        //
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Ver Detalle')){
            if(Plaza::where('IdPlaza', $id)->exists()){
            $plaza = Plaza::findOrFail($id);
            $plaza->unidad;
            return $plaza;
            }else{
                return response()->json("La plaza no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        if(Plaza::where('IdPlaza', $id)->exists()){
            $plaza = Plaza::findOrFail($id);
            $plaza->unidad;
            return $plaza;
        }else{
            return response()->json("La plaza no se ha encontrado", 404);
        }
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'NombrePlaza' => 'required|string|max:255|unique:Plaza',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Editar')){
            if(Plaza::where('IdPlaza', $id)->exists()){
            Plaza::where('IdPlaza', $id)->update(array('NombrePlaza' => $request['NombrePlaza'], 
            'IdUnidad' => $request['IdUnidad']));
            return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("El rol no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        
        if(Plaza::where('IdPlaza', $id)->exists()){
            Plaza::where('IdPlaza', $id)->update(array('NombrePlaza' => $request['NombrePlaza'], 
            'IdUnidad' => $request['IdUnidad']));
            return response()->json("El registro se ha actualizado con éxito", 200);
        }else{
            return response()->json("El rol no se ha encontrado", 404);
        }
    }    
}
