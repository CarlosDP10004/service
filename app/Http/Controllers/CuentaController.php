<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cuenta;

class CuentaController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        /*if(UsuarioController::validatepermissions($request, 'Cuentas', 'Ver Lista')){
            return Cuenta::all();
        }
        return response()->json("El usuario no tiene los permisos", 401);*/
        return Cuenta::all();
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'Codigo' => 'required|string|max:255|unique:Cuenta',
            'NombreCuenta' => 'required|string|max:255|unique:Cuenta',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Cuentas', 'Agregar')){
            Cuenta::create([
            'Codigo'=>$request->Codigo,
            'NombreCuenta'=>$request->NombreCuenta,
            ]);
            return response()->json("La cuenta se ha agregado con éxito", 200);
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        Cuenta::create([
            'Codigo'=>$request->Codigo,
            'NombreCuenta'=>$request->NombreCuenta,
        ]);
        return response()->json("La cuenta se ha agregado con éxito", 200);
    }

    public function show(Request $request, $id)
    {
        //
        /*
        if(UsuarioController::validatepermissions($request, 'Cuentas', 'Ver Detalle')){
            if(Cuenta::where('IdCuenta', $id)->exists()){
            $cuenta = Cuenta::findOrFail($id);            
            return $cuenta;
            }else{
                return response()->json("La cuenta no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        if(Cuenta::where('IdCuenta', $id)->exists()){
            $cuenta = Cuenta::findOrFail($id);            
            return $cuenta;
        }else{
            return response()->json("La cuenta no se ha encontrado", 404);
        }
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'NombreCuenta' => 'required|string|max:255|unique:Cuenta',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Editar')){
            if(Cuenta::where('IdCuenta', $id)->exists()){
            Cuenta::where('IdCuenta', $id)->update(array('NombreCuenta' => $request['NombreCuenta']));
            return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("La cuenta no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        
        if(Cuenta::where('IdCuenta', $id)->exists()){
            Cuenta::where('IdCuenta', $id)->update(array('NombreCuenta' => $request['NombreCuenta']));
            return response()->json("El registro se ha actualizado con éxito", 200);
        }else{
            return response()->json("La cuenta no se ha encontrado", 404);
        }
    } 
}
