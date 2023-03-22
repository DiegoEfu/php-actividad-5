<?php

namespace App\Http\Controllers;

use App\InsumosProducto;
use App\Producto;
use App\Insumo;
use Illuminate\Http\Request;

/**
 * Class InsumosProductoController
 * @package App\Http\Controllers
 */
class InsumosProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $insumosProducto = new InsumosProducto();
        $producto = Producto::find($req->query('id'));
        $insumos = Insumo::whereNotIn('id', $producto->insumos->pluck('id'))->get();

        return view('insumos_producto.create', compact('insumosProducto', 'producto', 'insumos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(InsumosProducto::$rules);

        $insumosProducto = InsumosProducto::create($request->all());

        return redirect()->route('insumos-productos.index')
            ->with('success', 'InsumosProducto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insumosProducto = InsumosProducto::find($id);

        return view('insumos-producto.show', compact('insumosProducto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insumosProducto = InsumosProducto::find($id);

        return view('insumos-producto.edit', compact('insumosProducto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InsumosProducto $insumosProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsumosProducto $insumosProducto)
    {
        request()->validate(InsumosProducto::$rules);

        $insumosProducto->update($request->all());

        return redirect()->route('insumos-productos.index')
            ->with('success', 'InsumosProducto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $insumosProducto = InsumosProducto::find($id)->delete();

        return redirect()->route('insumos-productos.index')
            ->with('success', 'InsumosProducto deleted successfully');
    }
}
