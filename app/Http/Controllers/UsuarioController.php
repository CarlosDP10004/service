<?php

namespace App\Http\Controllers;
use App\User;
use App\Rol;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //
    public function index()
    {
        return User::all();
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

    public function login(Request $request){
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

}
