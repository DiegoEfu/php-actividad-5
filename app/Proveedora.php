<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedora
 *
 * @property $id
 * @property $identificacion
 * @property $razon_social
 * @property $telefono
 * @property $correo_electronico
 * @property $direccion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proveedora extends Model
{
    
    static $rules = [
		'identificacion' => 'required',
		'razon_social' => 'required',
		'direccion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['identificacion','razon_social','telefono','correo_electronico','direccion'];



}
