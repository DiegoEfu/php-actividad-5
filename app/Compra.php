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
		'cantidad' => 'required|min:0',
		'referencia' => 'required|unique:compras,referencia',
		'insumo_id' => 'required',
		'proveedora_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cantidad','referencia','insumo_id','proveedora_id'];

    public function insumo(){
        return $this->hasOne('App\Insumo', 'id', 'insumo_id');
    }

    public function proveedora(){
        return $this->hasOne('App\Proveedora', 'id', 'proveedora_id');
    }

}
