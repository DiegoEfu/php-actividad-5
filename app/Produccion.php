<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Produccion
 *
 * @property $id
 * @property $cantidad
 * @property $producto_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Produccion extends Model
{

    static $rules = [
		'cantidad' => 'required|min:0.01',
		'producto_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cantidad','producto_id'];

    public function producto(){
        return $this->hasOne('App\Producto', 'id', 'producto_id');
    }

}
