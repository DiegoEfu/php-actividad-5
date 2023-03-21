<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compra
 *
 * @property $id
 * @property $cantidad
 * @property $referencia
 * @property $estado
 * @property $insumo_id
 * @property $proveedora_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Compra extends Model
{

    static $rules = [
		'cantidad' => 'required',
		'referencia' => 'required',
		'estado' => 'required',
		'insumo_id' => 'required',
		'proveedora_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cantidad','referencia','estado','insumo_id','proveedora_id'];

}
