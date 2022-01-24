<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectToP = RouteServiceProvider::HOME_PACIENTE;
    public function username()
    {
        return 'matricula';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('admin/login');
    }

    public function loginPaciente(Request $request)
    {
        $request->validate(
            [
                $this->username() => 'required|numeric',
            ]
        );
        if (Auth::guard('paciente')->check() && Auth::guard('paciente')->user()->matricula == $request->matricula) {
            return redirect($this->redirectToP);
        }

        $paciente = $this->verificarMatricula($request->matricula);
        if ($paciente != null) {
            Auth::guard('paciente')->login($paciente);
            return redirect($this->redirectToP);
        }
        return redirect()->back()->with("error", "Datos incorrectos");
    }


    private function verificarMatricula($matricula)
    {
        $paciente = Paciente::findMatricula($matricula);
        if ($paciente != null) {
            return $paciente;
        }
        //conectar a la api
        //
        return null;
    }

    public function salir(Request $request)
    {
        if (Auth::guard('paciente')->check()) {
            Auth::guard()->logout();
        }
        return redirect('/');
    }
}
