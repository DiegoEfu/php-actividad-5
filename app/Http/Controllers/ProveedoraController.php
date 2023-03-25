<?php

namespace App\Http\Controllers;

use Auth;
use App\Proveedora;
use Illuminate\Http\Request;

class ProveedoraController extends Controller
{
    public function index()
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "GESTOR DE COMPRAS")){
            return redirect('/login');
        }
        $proveedoras = Proveedora::paginate();

        return view('proveedora.index', compact('proveedoras'))
            ->with('i', (request()->input('page', 1) - 1) * $proveedoras->perPage());
    }

    public function create()
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "GESTOR DE COMPRAS")){
            return redirect('/login');
        }
        $proveedora = new Proveedora();
        return view('proveedora.create', compact('proveedora'));
    }

    public function store(Request $request)
    {
        request()->validate(Proveedora::$rules);

        $proveedora = Proveedora::create($request->all());

        return redirect()->route('proveedoras.index')
            ->with('success', 'Proveedora creada correctamente.');
    }

    public function show($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "GESTOR DE COMPRAS")){
            return redirect('/login');
        }
        $proveedora = Proveedora::find($id);

        return view('proveedora.show', compact('proveedora'));
    }

    public function edit($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "GESTOR DE COMPRAS")){
            return redirect('/login');
        }
        $proveedora = Proveedora::find($id);

        return view('proveedora.edit', compact('proveedora'));
    }

    public function update(Request $request, Proveedora $proveedora)
    {
        request()->validate(Proveedora::$rules);

        $proveedora->update($request->all());

        return redirect()->route('proveedoras.index')
            ->with('success', 'Proveedora actualizada correctamente.');
    }

    public function destroy($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN")){
            return redirect('/login');
        }
        $proveedora = Proveedora::find($id)->delete();

        return redirect()->route('proveedoras.index')
            ->with('success', 'Proveedora eliminada correctamente.');
    }
}
