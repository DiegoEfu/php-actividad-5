<?php

namespace App\Http\Controllers;

use App\Proveedora;
use Illuminate\Http\Request;

/**
 * Class ProveedoraController
 * @package App\Http\Controllers
 */
class ProveedoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedoras = Proveedora::paginate();

        return view('proveedora.index', compact('proveedoras'))
            ->with('i', (request()->input('page', 1) - 1) * $proveedoras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedora = new Proveedora();
        return view('proveedora.create', compact('proveedora'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Proveedora::$rules);

        $proveedora = Proveedora::create($request->all());

        return redirect()->route('proveedoras.index')
            ->with('success', 'Proveedora created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedora = Proveedora::find($id);

        return view('proveedora.show', compact('proveedora'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedora = Proveedora::find($id);

        return view('proveedora.edit', compact('proveedora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Proveedora $proveedora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedora $proveedora)
    {
        request()->validate(Proveedora::$rules);

        $proveedora->update($request->all());

        return redirect()->route('proveedoras.index')
            ->with('success', 'Proveedora updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $proveedora = Proveedora::find($id)->delete();

        return redirect()->route('proveedoras.index')
            ->with('success', 'Proveedora deleted successfully');
    }
}
