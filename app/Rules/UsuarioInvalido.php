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
        return "Esa cédula no está registrada en la base de datos.";
    }
}
