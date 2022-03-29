<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministrarContrasena extends Controller
{
    public function __construct()
    {
    }

    public function restorePassword(Request $request)
    {
        $this->validate($request, [
            "matricula" => "required|numeric|digits_between:6,12",
        ]);

        $matricula = $request->matricula;
        $admin = User::findMatricula($matricula);
        if (is_null($admin)) {
            return back()->with("error", "La matricula no existe");
        }
        $admin->password = Hash::make($matricula);
        $admin->update();
        return redirect('/admin/restablecer-contra')->with("success", "Contraseña restablecida correctamente");
    }

    public function showRestorePassword()
    {

        return view('admin.recover-password.index');
    }


    public function changePasswordPage()
    {
        return view('admin.change-password.index');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if(!Hash::check($request->password_actual, Auth::user()->password)){
            return redirect()->back()->with("error", "El campo contraseña actual no es correcta");
        }
        if ($request->password != $request->verify_password) {
            return redirect()->back()->with("error", "contraseñas incorrectas");
        }
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect()->back()->with("success", "La contraseña a sido cambiada exitosamente");
    }
}
