<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class InsumosProducto
 *
 * @property $id
 * @property $cantidad
 * @property $insumo_id
 * @property $producto_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InsumosProducto extends Pivot
{
    public $timestamps = false;
    static $rules = [
		'cantidad' => 'required|min:0.01',
		'insumo_id' => 'required|unique:insumos_producto,insumo_id,producto_id',
		'producto_id' => 'required|unique:insumos_producto,insumo_id,producto_id',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $casts = ['cantidad','insumo_id','producto_id'];

}
