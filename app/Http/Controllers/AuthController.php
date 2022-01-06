<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::attempt($request->only('NombreUsuario', 'Contrasenna'))){
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('NombreUsuario', $request['NombreUsuario'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
