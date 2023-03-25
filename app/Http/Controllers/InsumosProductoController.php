<?php

namespace App\Http\Controllers;

use Auth;
use App\InsumosProducto;
use App\Producto;
use App\Insumo;
use Illuminate\Http\Request;

class InsumosProductoController extends Controller
{
    public function create(Request $req)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "ALMACENISTA")){
            return redirect('/login');
        }
        $insumosProducto = new InsumosProducto();
        $producto = Producto::find($req->query('id'));
        $insumos = Insumo::whereNotIn('id', $producto->insumos->pluck('id'))->get();

        return view('insumos_producto.create', compact('insumosProducto', 'producto', 'insumos'));
    }

    public function store(Request $request)
    {
        request()->validate(InsumosProducto::$rules);

        $insumosProducto = InsumosProducto::create($request->all());

        return redirect()->route('productos.show', $insumosProducto['producto_id'])
            ->with('success', 'Añadido insumo necesario.');
    }

    public function show($id)
    {
        $insumosProducto = InsumosProducto::find($id);

        return view('insumos-producto.show', compact('insumosProducto'));
    }

    public function edit($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "ALMACENISTA")){
            return redirect('/login');
        }
        $insumosProducto = InsumosProducto::find($id);

        $producto = Producto::find($insumosProducto->producto_id);
        $insumos = Insumo::where('id',$insumosProducto->insumo_id)->get();

        return view('insumos_producto.edit', compact('insumosProducto', 'producto', 'insumos'));
    }

    public function update(Request $request, InsumosProducto $insumosProducto)
    {
        request()->validate(InsumosProducto::$rules);

        $insumosProducto->update($request->all());

        return redirect()->route('productos.show', $request->producto_id)
            ->with('success', 'Insumo necesario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" )){
            return redirect('/login');
        }
        $insumosProducto = InsumosProducto::find($id);
        $idProducto = $insumosProducto->producto_id;
        $insumosProducto->delete();

        return redirect()->route('productos.show', $idProducto)
        ->with('success', 'Insumo necesario eliminado correctamente.');
    }
}
