<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Schema(
 *      title="Create or Update Artist Request",
 *      type="object",
 *      required={"name", "email", "password", "password_confirmation"}
 * )
 */
class CreateOrUpdateArtistRequest extends FormRequest
{
    /** @OA\Property(property="id", type="string", example="1") */
    private $id;

    /** @OA\Property(property="name", type="string", example="Frah Quintale") */
    private $name;

    /** @OA\Property(property="email", type="string", example="frah.quintale@gmail.com") */
    private $email;

    /** @OA\Property(property="password", type="string", example="secretpassword") */
    private $password;

    /** @OA\Property(property="password_confirmation", type="string", example="secretpassword") */
    private $password_confirmation;


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
