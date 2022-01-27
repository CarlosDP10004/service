<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
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

    public function login(Request $request){
        $result = DB::select('CALL AutenticarUsuario( :nombre_usuario, :claveUsuario )', [$request['NombreUsuario'], $request['Contrasenna']]);      
       
        switch($result['Id']){
            case(0):
                return response()->json(['message' => 'El usuario no se encuentra registrado.'], 401);
                break;
            case(1):
                return response()->json(['message' => 'Contraseña invalida.'], 401);
                break;
            case(2):
                return response()->json(['message' => 'Su usuario se encuentra bloqueado.'], 401);
                break;
            case(3):
                return response()->json(['message' => 'Su usuario se encuentra bloqueado.'], 401);
                break;
            default:
            $user = User::where('NombreUsuario', $request['NombreUsuario'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token,'token_type' => 'Bearer']);
        }                    

    }
}
