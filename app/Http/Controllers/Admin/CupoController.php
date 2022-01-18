<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CupoRequest;
use App\Models\Cupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CupoController extends Controller
{
    public function index()
    {
        $cupos = Cupo::all()->sortBy('id');
        //dd($cupos);
        return view('admin.cupo.index')->with('cupos', $cupos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cupo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CupoRequest $request)
    {
        $this->desactAll();
        $cupo = new Cupo();
        $cupo->total = $request->cupo;
        $cupo->estado = true;
        $cupo->save();
        return redirect('admin/cupo');
    }


    public function activar(Cupo $cupo)
    {
        if ($cupo->estado) {
            return back()->with("cupo", "No se puede eliminar un cupo ACTIVO, active otro cupo e intente nuevamente");
        }
        $this->desactAll();
        $cupo->estado = true;
        $cupo->update();
        return redirect()->back();
    }


    public function destroy(Cupo $cupo)
    {
        if ($cupo->estado) {
            return back()->withErrors("cupo", "No se puede eliminar un cupo ACTIVO, active otro cupo e intente nuevamente");
        }
        $cupo->delete();
        return redirect()->back();
    }

    private function desactAll()
    {
        DB::table('cupos')->update(['estado' => false]);
    }
}
