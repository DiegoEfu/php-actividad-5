<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $insumos = Insumo::paginate();

        return view('insumo.index', compact('insumos'))
            ->with('i', (request()->input('page', 1) - 1) * $insumos->perPage());
    }

    public function pdf()
    {
        $insumos = Insumo::orderBy('nombre')->get();

        $i = 0;

        $pdf = PDF::loadView('insumo.pdf', ['insumos' => $insumos, 'i' => $i]);
        return $pdf->stream();
    }

    public function create()
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        $insumo = new Insumo();
        return view('insumo.create', compact('insumo'));
    }

    public function store(Request $request)
    {
        request()->validate(Insumo::$rules);

        $insumo = Insumo::create($request->all());

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo creado correctamente.');
    }

    public function show($id)
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        $insumo = Insumo::find($id);

        return view('insumo.show', compact('insumo'));
    }

    public function edit($id)
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        $insumo = Insumo::find($id);

        return view('insumo.edit', compact('insumo'));
    }

    public function update(Request $request, Insumo $insumo)
    {
        request()->validate(Insumo::$rules);

        $insumo->update($request->all());

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo updated successfully');
    }

    public function destroy($id)
    {
        if(!Auth::check() || Auth::user()->cargo != 'ADMIN'){
            return redirect('/login');
        }
        $insumo = Insumo::find($id)->delete();

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo deleted successfully');
    }
}
