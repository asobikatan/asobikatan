<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //ミドルウェアにてua判定
    public function about(Request $request){
        return view('abouts.about', ['ua' => $request->ua . 'objects.common']);
    }

    public function kiyaku(Request $request){
        return view('abouts.kiyaku', ['ua' => $request->ua . 'objects.common']);
    }

    public function kojin(Request $request){
        return view('abouts.kojin', ['ua' => $request->ua . 'objects.common']);
    }
}
