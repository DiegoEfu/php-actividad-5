<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $nombre
 * @property $precio_actual
 * @property $codigo_barra
 * @property $stock
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{

    static $rules = [
		'nombre' => 'required|unique:productos,nombre',
		'precio_actual' => 'required',
		'codigo_barra' => 'required|unique:productos,codigo_barra',
		'stock' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','precio_actual','codigo_barra'];
    protected $hidden = [
        'stock',
    ];


}
