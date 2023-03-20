<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'cedula' => 'required|unique:users,cedula',
            'cargo' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
}