<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateOrUpdateArtistRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['nullable', 'filled', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'unique:artists,email,' . $this->get('id')],
            'password' => ['required', 'min:5', 'max:25', 'confirmed'],
            'password_confirmation' => ['required', 'min:5', 'max:25']
        ];
    }

    public function getAttributes(): array
    {
        return array_merge(
            $this->only(['id', 'name', 'email']),
            ['password' => Hash::make($this->get('password'))]
        );
    }
}
