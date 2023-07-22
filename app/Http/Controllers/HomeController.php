<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function getHome() {
        if(!Session::get('username')) {
            return response()->json([
                'message' => 'Sesión expirada'
            ], 201);
        }

        $item = Home::find(1);

        return response()->json([
            'item' => $item
        ], 200);
    }

    public function getWebHome() {
        $item = Home::find(1);

        return response()->json([
            'item' => $item
        ], 200);
    }

    public function updateHome(Request $request) {
        if(!Session::get('username')) {
            return response()->json([
                'message' => 'Sesión expirada'
            ], 201);
        }

        $item = Home::find(1);

        $item->title = $request->title;
        $item->title_section1 = $request->title_section1;
        $item->text_section1 = $request->text_section1;

        $item->title_section2 = $request->title_section2;
        $item->text_section2 = $request->text_section2;
        $item->subtitle1_section2 = $request->subtitle1_section2;
        $item->text1_section2 = $request->text1_section2;

        $item->subtitle2_section2 = $request->subtitle2_section2;
        $item->text2_section2 = $request->text2_section2;

        $item->subtitle3_section2 = $request->subtitle3_section2;
        $item->text3_section2 = $request->text3_section2;

        $item->title_section3 = $request->title_section3;

        if($request->hasFile('image')){
            $request->image->move(public_path('img'), $request->image->getClientOriginalName());

            $item->image = '/img/' . $request->image->getClientOriginalName();
        }

        if($request->hasFile('image_section1')){
            $request->image_section1->move(public_path('img'), $request->image_section1->getClientOriginalName());

            $item->image_section1 = '/img/' . $request->image_section1->getClientOriginalName();
        }

        if($request->hasFile('image1_section2')){
            $request->image1_section2->move(public_path('img'), $request->image1_section2->getClientOriginalName());

            $item->image1_section2 = '/img/' . $request->image1_section2->getClientOriginalName();
        }

        if($request->hasFile('image2_section2')){
            $request->image2_section2->move(public_path('img'), $request->image2_section2->getClientOriginalName());

            $item->image2_section2 = '/img/' . $request->image2_section2->getClientOriginalName();
        }

        if($request->hasFile('image3_section2')){
            $request->image3_section2->move(public_path('img'), $request->image3_section2->getClientOriginalName());

            $item->image3_section2 = '/img/' . $request->image3_section2->getClientOriginalName();
        }

        $item->save();

        return response()->json([
            'message' => 'Datos actualizados'
        ], 200);
    }
}
