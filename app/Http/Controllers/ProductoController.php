<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Producto;
use Illuminate\Http\Request;
use App\Insumo;
use App\InsumosProducto;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    public function index()
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'ALMACENISTA')){
            return redirect('/login');
        }
        $productos = Producto::paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    public function pdf()
    {
        $productos = Producto::orderBy('nombre')->get();

        $i = 0;

        $pdf = PDF::loadView('producto.pdf', ['productos' => $productos, 'i' => $i]);
        return $pdf->stream();
    }

    public function create()
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'ALMACENISTA')){
            return redirect('/login');
        }
        $producto = new Producto();

        $insumos = Insumo::all();
        return view('producto.create', compact('producto','insumos'));
    }

    public function store(Request $request)
    {
        request()->validate(Producto::$rules);

        $producto = Producto::create($request->all());
        $insumo = InsumosProducto::create(['insumo_id' => $request->insumo_id, 'cantidad' => $request->cantidad, 'producto_id' => $producto->id]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'ALMACENISTA')){
            return redirect('/login');
        }
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    public function edit($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN' && Auth::user()->cargo != 'ALMACENISTA')){
            return redirect('/login');
        }
        $producto = Producto::find($id);

        return view('producto.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        request()->validate(Producto::$rules);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto editado correctamente.');
    }

    public function destroy($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != 'ADMIN')){
            return redirect('/productos');
        }
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
