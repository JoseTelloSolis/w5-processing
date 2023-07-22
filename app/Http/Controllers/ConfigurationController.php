<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ConfigurationController extends Controller {

    public function getConfig() {
        if(!isset($_SESSION['username'])) {
            return response()->json([
                'message' => 'Sesión expirada'
            ], 201);
        }

        $item = Configuration::find(1);

        return response()->json([
            'item' => $item
        ], 200);
    }

    public function getWebConfig() {
        $item = Configuration::find(1);

        return response()->json([
            'item' => $item
        ], 200);
    }

    public function updateConfig(Request $request) {
        $item = Configuration::find(1);
        $item->instagram = $request->instagram;
        $item->facebook = $request->facebook;
        $item->linkedin = $request->linkedin;

        if($request->hasFile('logo')){
            $request->logo->move(public_path('img'), $request->logo->getClientOriginalName());

            $item->logo = '/img/' . $request->logo->getClientOriginalName();
        }

        $item->save();

        return response()->json([
            'message' => 'Datos actualizados'
        ], 200);
    }
}
