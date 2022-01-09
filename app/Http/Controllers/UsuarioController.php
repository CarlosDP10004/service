<?php

namespace App\Http\Controllers;
use App\User;
use App\Rol;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //
    public function index(Request $request)
    {   
        if($this->validatepermissions($request, 'Usuarios', 'Ver Lista')){
            return User::all();
        }
        return response()->json("El usuario no tiene los permisos", 401);        
    }

    public function register(Request $request){
        $validatedData = $request->validate([            
            'NombreUsuario' => 'required|string|max:255|unique:Usuario',
            'Contrasenna' => 'required|string|min:8'
        ]);
        $user = User::create([
            'NombreUsuario' => $validatedData['NombreUsuario'],
            'Contrasenna' => $validatedData['Contrasenna'],
            'Estado' => 1,
            'Intento' => 0,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'NombreUsuario' => 'required|string|max:255|unique:Usuario',
            'Contrasenna' => 'required|string|min:8'
        ]);

        if($this->validatepermissions($request, 'Usuarios', 'Agregar')){
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
        return response()->json("El usuario no tiene los permisos", 401); 
    }

    public function login(Request $request){
        $request->validate([            
            'NombreUsuario' => 'required|string|max:255',
            'Contrasenna' => 'required|string|min:8'
        ]);
        $result = DB::select('CALL AutenticarUsuario( :nombre_usuario, :claveUsuario )', [$request['NombreUsuario'], $request['Contrasenna']]);      
       
        switch($result[0]->Id){
            case(0):
                return response()->json(['message' => 'User is not registered'], 401);
                break;
            case(1):
                return response()->json(['message' => 'Invalid password'], 401);
                break;
            case(2):
                return response()->json(['message' => 'User is blocked'], 401);
                break;
            case(3):
                return response()->json(['message' => 'User is blocked'], 401);
                break;
            default:
            $user = User::where('NombreUsuario', $request['NombreUsuario'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token,'token_type' => 'Bearer']);
        }
    }

    public function show(Request $request, $id){
        if($this->validatepermissions($request, 'Usuarios', 'Ver Detalle')){
            if(User::where('IdUsuario', $id)->exists()){
                $user = User::findOrFail($id);
                $user->roles;
                return $user;
            }else{
                return response()->json("El usuario no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401); 
    }

    public function update(Request $request, $id){  
        
        $this->validate($request, [
            'NombreUsuario' => 'required|max:255',
            'Contrasenna' => 'required|max:255'
        ]);
        if($this->validatepermissions($request, 'Usuarios', 'Editar')){
            if(User::where('IdUsuario', $id)->exists()){
                User::where('IdUsuario', $id)->update(array('NombreUsuario' => $request['NombreUsuario'], 'Contrasenna' => $request['Contrasenna']));
                User::find($id)->roles()->sync($request['Roles']);               
                return response()->json("El registro se ha actualizado con éxito", 200);
            }else{
                return response()->json("El usuario no se ha encontrado", 404);
            }
        }
        return response()->json("El usuario no tiene los permisos", 401); 
    }

    public static function validatepermissions($request, $modulo, $permission){
        $user = $request->user();
        $roles = $user->roles;
        foreach($roles as $rol){
            $permisos = $rol->permisos;
            foreach($permisos as $permiso){
                if($permiso['Modulo'] == $modulo && $permiso['NombrePermiso'] == $permission){
                    return true;
                }
            }
        }
        return false;
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json("Se ha cerrado sesión", 200);
    }
}
