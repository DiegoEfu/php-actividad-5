<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Produccion
 *
 * @property $id
 * @property $cantidad
 * @property $producto_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Produccion extends Model
{
    
    static $rules = [
		'cantidad' => 'required',
		'producto_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cantidad','producto_id'];



}
