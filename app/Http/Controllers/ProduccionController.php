<?php

namespace App\Http\Controllers;

use App\Produccion;
use App\Producto;
use Illuminate\Http\Request;
use App\Rules\InsumosInsuficientes;

/**
 * Class ProduccionController
 * @package App\Http\Controllers
 */
class ProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produccions = Produccion::orderBy('id', 'desc')->paginate();

        return view('produccion.index', compact('produccions'))
            ->with('i', (request()->input('page', 1) - 1) * $produccions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produccion = new Produccion();
        $productos = Producto::all();

        return view('produccion.create', compact('produccion', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produccion = Produccion::find($id);

        return view('produccion.show', compact('produccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produccion = Produccion::find($id);
        $productos = Producto::all();

        return view('produccion.edit', compact('produccion', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Produccion $produccion
     * @return \Illuminate\Http\Response
     */
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

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
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
