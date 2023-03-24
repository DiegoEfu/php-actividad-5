<?php

namespace App\Http\Controllers;

use DB;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::paginate();

        $data = DB::select('SELECT nombre,SUM(cantidad) AS cantidad FROM compras INNER JOIN insumos AS p ON insumo_id = p.id GROUP BY nombre ORDER BY cantidad DESC LIMIT 10');
        $data = json_encode($data);

        return view('compra.index', compact('compras', 'data'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compra = new Compra();

        $proveedoras = Proveedora::all();
        $insumos = Insumo::all();

        return view('compra.create', compact('compra', 'proveedoras', 'insumos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Compra::$rules);

        $compra = Compra::create($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $compra = Compra::find($id);

        $proveedoras = Proveedora::all();
        $insumos = Insumo::all();

        return view('compra.edit', compact('compra','proveedoras', 'insumos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Compra $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        request()->validate(Compra::$rules);

        $compra->update($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compra = Compra::find($id)->delete();

        return redirect()->route('compras.index')
            ->with('success', 'Compra deleted successfully');
    }
}
