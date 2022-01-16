<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        /*if(UsuarioController::validatepermissions($request, 'Proveedores', 'Ver Lista')){
            return Proveedor::all();
        }
        return response()->json("El usuario no tiene los permisos", 401);*/
        return Proveedor::all();
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'NombreProveedor' => 'required|string|max:255|unique:Proveedor',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Agregar')){
            Proveedor::create([
            'NombreProveedor'=>$request->NombreProveedor,
            ]);
            return response()->json("El proveedor se ha agregado con éxito", 200);
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        Proveedor::create([
            'NombreProveedor'=>$request->NombreProveedor,
        ]);
        return response()->json("El proveedor se ha agregado con éxito", 200);
    }

    public function show(Request $request, $id)
    {
        //
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Ver Detalle')){
            if(Proveedor::where('IdProveedor', $id)->exists()){
            $proveedor = Proveedor::findOrFail($id);            
            return $proveedor;
            }else{
                return response()->json("El proveedor no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        if(Proveedor::where('IdProveedor', $id)->exists()){
            $proveedor = Proveedor::findOrFail($id);            
            return $proveedor;
        }else{
            return response()->json("El proveedor no se ha encontrado", 404);
        }
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'NombreProveedor' => 'required|string|max:255|unique:Proveedor',
        ]);
        /*
        if(UsuarioController::validatepermissions($request, 'Plazas', 'Editar')){
            if(Proveedor::where('IdProveedor', $id)->exists()){
            Proveedor::where('IdProveedor', $id)->update(array('NombreProveedor' => $request['NombreProveedor']));
            return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("El proveedor no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401);
        */
        
        if(Proveedor::where('IdProveedor', $id)->exists()){
            Proveedor::where('IdProveedor', $id)->update(array('NombreProveedor' => $request['NombreProveedor']));
            return response()->json("El registro se ha actualizado con éxito", 200);
        }else{
            return response()->json("El proveedor no se ha encontrado", 404);
        }
    } 
}
