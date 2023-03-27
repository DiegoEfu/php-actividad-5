<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;

use App\Compra;
use App\Insumo;
use App\Proveedora;
use Illuminate\Http\Request;

/**
 * Class CompraController
 * @package App\Http\Controllers
 */
class CompraController extends Controller
{
    public function index()
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'GESTOR DE COMPRAS')){
            return redirect('/login');
        }

        $compras = Compra::paginate();

        $data = DB::select('SELECT nombre,SUM(cantidad) AS cantidad FROM compras INNER JOIN insumos AS p ON insumo_id = p.id GROUP BY nombre ORDER BY cantidad DESC LIMIT 10');
        $data = json_encode($data);

        return view('compra.index', compact('compras', 'data'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    public function pdf_abiertas()
    {
        $compras = Compra::where('estado', 'A')->get();
        $i = 0;
        $total = 0;
        $tipo = "ABIERTAS";

        $pdf = PDF::loadView('compra.pdf', ['compras' => $compras, 'i' => $i, 'tipo' => $tipo, 'total' => $total]);
        return $pdf->stream();
    }

    public function pdf_cerradas()
    {
        $compras = Compra::where('estado', 'C')->get();
        $i = 0;
        $total = 0;
        $tipo = "CERRADAS";

        $pdf = PDF::loadView('compra.pdf', ['compras' => $compras, 'i' => $i, 'tipo' => $tipo, 'total' => $total]);
        return $pdf->stream();
    }

    public function create()
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'GESTOR DE COMPRAS')){
            return redirect('/login');
        }
        $compra = new Compra();

        $proveedoras = Proveedora::all();
        $insumos = Insumo::all();

        return view('compra.create', compact('compra', 'proveedoras', 'insumos'));
    }

    public function store(Request $request)
    {
        request()->validate(Compra::$rules);

        $compra = Compra::create($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra created successfully.');
    }

    public function show($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'GESTOR DE COMPRAS')){
            return redirect('/login');
        }
        $compra = Compra::find($id);
        $compra->estado = 'C';

        $compra->insumo->stock += $compra->cantidad;
        $compra->save();

        return redirect()->route('compras.index')
            ->with('success', 'Compra cerrada con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'GESTOR DE COMPRAS')){
            return redirect('/login');
        }
        $compra = Compra::find($id);

        $proveedoras = Proveedora::all();
        $insumos = Insumo::all();

        return view('compra.edit', compact('compra','proveedoras', 'insumos'));
    }

    public function update(Request $request, Compra $compra)
    {
        request()->validate(Compra::$rules);

        $compra->update($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra updated successfully');
    }

    public function destroy($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN')){
            return redirect('/compras');
        }
        $compra = Compra::find($id)->delete();

        return redirect()->route('compras.index')
            ->with('success', 'Compra deleted successfully');
    }
}
