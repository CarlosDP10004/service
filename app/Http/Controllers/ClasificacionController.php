<?php

namespace App\Http\Controllers;

use App\Clasificacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        /*if(UsuarioController::validatepermissions($request, 'Clasificaciones', 'Ver Lista')){
            return Clasificacion::all();
        }
        return response()->json("El usuario no tiene los permisos", 401);*/
        return Clasificacion::all();
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'Descripcion' => 'required|string|max:255|unique:Clasificacion',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Agregar')){
            Clasificacion::create([
            'IdCuenta'=>$request->IdCuenta,
            'Descripcion'=>$request->NombreProveedor,
            ]);
            return response()->json("La clasificación se ha agregado con éxito", 200);
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        Clasificacion::create([
            'IdCuenta'=>$request->IdCuenta,
            'Descripcion'=>$request->Descripcion,
        ]);
        return response()->json("La clasificación se ha agregado con éxito", 200);
    }

    public function show(Request $request, $id)
    {
        //
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Ver Detalle')){
            if(Clasificacion::where('IdClasificacion', $id)->exists()){
            $clasificacion = Clasificacion::findOrFail($id);            
            $clasificacion->cuenta;
            return $clasificacion;
            }else{
                return response()->json("La clasificación no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        if(Clasificacion::where('IdClasificacion', $id)->exists()){
            $clasificacion = Clasificacion::findOrFail($id);            
            $clasificacion->cuenta;
            return $clasificacion;
        }else{
            return response()->json("La clasificación no se ha encontrado", 404);
        }
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'Descripcion' => 'required|string|max:255|unique:Clasificacion',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Editar')){
            if(Clasificacion::where('IdClasificacion', $id)->exists()){
                Clasificacion::where('IdClasificacion', $id)->update(array('Descripcion' => $request['Descripcion'],
                'IdCuenta' => $request['IdCuenta']));
                return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("La clasificación no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        
        if(Clasificacion::where('IdClasificacion', $id)->exists()){
            Clasificacion::where('IdClasificacion', $id)->update(array('Descripcion' => $request['Descripcion'],
        'IdCuenta' => $request['IdCuenta']));
            return response()->json("El registro se ha actualizado con éxito", 200);
        }else{
            return response()->json("La clasificación no se ha encontrado", 404);
        }
    } 
}
