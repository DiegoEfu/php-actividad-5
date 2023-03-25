<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Produccion;
use App\Producto;
use Illuminate\Http\Request;
use App\Rules\InsumosInsuficientes;

class ProduccionController extends Controller
{
    public function index()
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "ALMACENISTA")){
            return redirect('/login');
        }

        $produccions = Produccion::orderBy('id', 'desc')->paginate();

        $data = DB::select('SELECT nombre,SUM(cantidad) AS cantidad FROM produccions INNER JOIN productos AS p ON producto_id = p.id GROUP BY nombre ORDER BY cantidad DESC LIMIT 10');
        $data = json_encode($data);

        return view('produccion.index', compact('produccions','data'))
            ->with('i', (request()->input('page', 1) - 1) * $produccions->perPage());
    }

    public function create()
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "ALMACENISTA")){
            return redirect('/login');
        }

        $produccion = new Produccion();
        $productos = Producto::all();

        return view('produccion.create', compact('produccion', 'productos'));
    }

    public function store(Request $request)
    {
        $insumos = Producto::find($request->producto_id)->insumos;
        if(request()->validate(Produccion::$rules)){
            foreach ($insumos as $insumo) {
                $stock = $insumo->stock;
                $cantidad_p = $request->cantidad;
                $cantidad_i = $insumo->pivot->cantidad;
                if($stock < $cantidad_p*$cantidad_i){
                    $request->validate([
                        'cantidad' => ['required', new InsumosInsuficientes],
                    ]);
                }
            }

            foreach ($insumos as $insumo) {
                $cantidad_p = (float)$request->cantidad;
                $cantidad_i = $insumo->pivot->cantidad;

                $insumo->stock -= $cantidad_p*$cantidad_i;
                $insumo->save();
            }
        }

        $produccion = Produccion::create($request->all());
        $produccion->producto->stock += (float)$request->cantidad;
        $produccion->producto->save();

        return redirect()->route('produccions.index')
            ->with('success', 'Producción registrada exitosamente.');
    }

    public function pdf()
    {
        $produccions = Produccion::orderBy('id', 'asc')->paginate();
        $i = 0;

        $pdf = PDF::loadView('produccion.pdf', ['produccions' => $produccions, 'i' => $i]);
        return $pdf->stream();
    }

    public function show($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "ALMACENISTA")){
            return redirect('/login');
        }
        $produccion = Produccion::find($id);

        return view('produccion.show', compact('produccion'));
    }

    public function edit($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN" && Auth::user()->cargo != "ALMACENISTA")){
            return redirect('/login');
        }
        $produccion = Produccion::find($id);
        $productos = Producto::all();

        return view('produccion.edit', compact('produccion', 'productos'));
    }

    public function update(Request $request, Produccion $produccion)
    {
        request()->validate(Produccion::$rules);

        $insumos = $produccion->producto->insumos;
        if(request()->validate(Produccion::$rules)){
            foreach ($insumos as $insumo) {
                $cantidad_p = (float)$produccion->cantidad;
                $cantidad_i = $insumo->pivot->cantidad;

                $insumo->stock += $cantidad_p*$cantidad_i;
                $insumo->save();
            }

            foreach ($insumos as $insumo) {
                $stock = $insumo->stock;
                $cantidad_p = $request->cantidad;
                $cantidad_i = $insumo->pivot->cantidad;
                if($stock < $cantidad_p*$cantidad_i){
                    $request->validate([
                        'cantidad' => ['required', new InsumosInsuficientes],
                    ]);
                }
            }

            $produccion->producto->stock -= (float)$produccion->cantidad;
            $produccion->producto->save();

            foreach ($insumos as $insumo) {
                $cantidad_p = (float)$request->cantidad;
                $cantidad_i = $insumo->pivot->cantidad;

                $insumo->stock -= $cantidad_p*$cantidad_i;
                $insumo->save();
            }
        }

        $produccion->producto->stock += (float)$request->cantidad;
        $produccion->producto->save();

        $produccion->update($request->all());

        return redirect()->route('produccions.index')
            ->with('success', 'Producción actualizada correctamente');
    }

    public function destroy($id)
    {
        if(!Auth::check() || (Auth::user()->cargo != "ADMIN")){
            return redirect('/login');
        }
        $produccion = Produccion::find($id);

        $insumos = $produccion->producto->insumos;
        foreach ($insumos as $insumo) {
            $cantidad_p = (float)$produccion->cantidad;
            $cantidad_i = $insumo->pivot->cantidad;

            $insumo->stock += $cantidad_p*$cantidad_i;
            $insumo->save();
        }

        $produccion->producto->stock -= (float)$produccion->cantidad;
        $produccion->producto->save();

        $produccion->delete();

        return redirect()->route('produccions.index')
            ->with('success', 'Producción eliminada correctamente.');
    }
}
