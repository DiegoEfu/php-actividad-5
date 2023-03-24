<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class InsumosInsuficientes implements Rule
{
    public function passes($attribute, $value)
    {
        return FALSE;
    }

    public function message()
    {
        return "No hay insumos suficientes para producir esta cantidad del producto.";
    }
}
