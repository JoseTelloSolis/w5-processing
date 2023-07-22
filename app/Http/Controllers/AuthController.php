<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request) {

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            //$user = Auth::user();
            $user = $request->user();

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['username'] = $user->username;

            Session::put('username', $user->username);

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
            Session::forget('username');
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

    public function getProfile() {

        if(!Session::get('username')) {
            return response()->json([
                'message' => 'Sesión expirada'
            ], 201);
        }

        $id = Auth::user()->id;
        $item = User::find($id);

        return response()->json([
            'item' => $item
        ], 200);
    }

    public function updateProfile(Request $request) {

        if(!Session::get('username')) {
            return response()->json([
                'message' => 'Sesión expirada'
            ], 201);
        }

        $id = Auth::user()->id;
        $item = User::find($id);
        $item->name = $request->name;
        $item->lastname = $request->lastname;
        $item->email = $request->email;

        if($request->hasFile('image')){
            $request->image->move(public_path('img'), $request->image->getClientOriginalName());

            $item->image = '/img/' . $request->image->getClientOriginalName();
        }

        $item->save();

        return response()->json([
            'message' => 'Datos actualizados'
        ], 200);
    }
}
