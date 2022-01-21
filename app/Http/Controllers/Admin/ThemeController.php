<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function mostrar()
    {
        return view('admin.theme.index');
    }

    public function themes(Request $request)
    {
        $user = Auth::user();
        print($request->input('turno'));
        $user->light = $request->input('turno') == "1" ? true : false;
        $user->theme = $request->input('tema');
        $user->update();
        return redirect()->back();
    }
}
