<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            //$user = Auth::user();
            $user = $request->user();

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['username'] = $user->username;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'Usuario identificado correctamente'
            ];
        }
        else {
            $response = [
                'success' => false,
                'message' => 'Usuario o contraseña incorrecta'
            ];
        }

        return response()->json($response, 200);
    }

    public function logout() {
        try {
            Auth::logout();
            $success = true;
            $message = 'Sesión finalizada';
        }
        catch(\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
}
