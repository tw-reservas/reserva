<?php

namespace App\Http\Controllers\AuthPaciente;

use App\Contracts\CpsServices;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPacienteController extends Controller
{
    private $restCpsAdapter;

    public function __construct(CpsServices $cpsService)
    {
        $this->restCpsAdapter = $cpsService;
    }

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME_PACIENTE;

    public function username()
    {
        return 'matricula';
    }

    public function showLoginForm()
    {
        return view('welcome');
    }

    protected function guard()
    {
        return Auth::guard('paciente');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|numeric',
        ]);
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->guard()->check() && $this->guard()->user()->matricula == $request->matricula) {
            return redirect($this->redirectTo);
        }

        $paciente = $this->verificarMatricula($request->matricula);
        if (!is_null($paciente)) {
            return $this->loginSuccessFull($paciente);
        }

        return redirect()->back()->with("error", "Datos incorrectos");
    }

    private function loginSuccessFull($paciente)
    {
        $this->guard()->login($paciente);
        return redirect($this->redirectTo);
    }

    private function verificarMatriculaCps($matricula)
    {
        return $this->restCpsAdapter->getUser($matricula);
    }

    private function verificarMatriculaLocal($matricula)
    {
        return Paciente::findMatricula($matricula);
    }


    private function verificarMatricula($matricula)
    {
        $paciente = $this->verificarMatriculaLocal($matricula);
        if (!is_null($paciente)) {
            return $paciente;
        }
        $paciente = $this->verificarMatriculaCps($matricula);
        return $paciente;

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function salir(Request $request)
    {
        if ($this->guard()->check()) {
            $this->guard()->logout();
        }
        return redirect('/');
    }
}
