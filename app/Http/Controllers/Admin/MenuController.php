<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showAssignPrivileges()
    {
        $roles = Rol::orderBy('id')->get();
        return view('admin.assign-privileges.index', compact('roles'));
    }
}
