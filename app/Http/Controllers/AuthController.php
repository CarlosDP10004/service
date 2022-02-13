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
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
    }

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
        $user = $request['NombreUsuario'];
        $pass = $request['Contrasenna'];
        if(!(User::where('NombreUsuario', $user)->exists())){
            return response()->json(['message' => 'El usuario no existe reviselo.'], 401);
        }
        $session = User::where(['NombreUsuario' => $user, 'Contrasenna' => $pass])->first();
        if($session === null){
            if((User::where('NombreUsuario', $user)->firstOrFail())['Intento'] == 2){
                User::where('NombreUsuario', $user)->update(array('Estado' => 0));
            }
            if((User::where('NombreUsuario', $user)->firstOrFail())['Intento'] > 2){
                return response()->json(['message' => 'Su usuario se encuentra bloqueado.'], 401);
            }
            $intento = User::where('NombreUsuario', $user)->firstOrFail()['Intento'] + 1;
            User::where('NombreUsuario', $user)->update(array('Intento' => $intento));
            return response()->json(['message' => 'Contraseña invalida.'], 401);
        }
        if((User::where('NombreUsuario', $user)->firstOrFail())['Estado'] == false){
            return response()->json(['message' => 'Su usuario se encuentra bloqueado.'], 401);
        }
        $token = auth( $this->guard )->login( $session );
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
}
