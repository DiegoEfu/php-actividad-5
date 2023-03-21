<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Insumo
 *
 * @property $id
 * @property $nombre
 * @property $precio
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Insumo extends Model
{

    static $rules = [
		'nombre' => 'required|unique:insumos,nombre',
		'precio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','precio'];

    public function compras(){
        return $this->hasMany('App\Insumo', 'insumo_id', 'id');
    }

}
