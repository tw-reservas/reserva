<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('rolUser:id,nombre')->orderBy('id')->get();
        dd($user);
        return view('admin.user.index')->with('users', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Rol::all();
        return view('admin.user.create')->with('rols', $rol);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->password != $request->password1) {
        }
        $user = new User();
        $user->matricula = $request->matricula;
        $user->name = $request->nombre;
        $user->apellidoPaterno = $request->paterno;
        $user->apellidoMaterno = $request->materno;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->rol = "X";
        $user->telefono = $request->telefono;
        $user->rol_id = $request->input('roles');
        $user->save();
        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $rol = Rol::all();
        return view('admin.user.update')->with('user', $user)->with('roles', $rol);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->rol_id = $request->input('roles');
        $user->update();
        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
