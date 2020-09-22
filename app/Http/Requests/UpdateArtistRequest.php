<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Schema(
 *      title="Update Artist Request",
 *      type="object",
 *      required={"id", "name", "last_name", "bio", "email", "password", "password_confirmation"}
 * )
 */
class UpdateArtistRequest extends FormRequest
{
    /** @OA\Property(property="id", type="string", example="1") */
    /** @OA\Property(property="name", type="string", example="Frah") */
    /** @OA\Property(property="last_name", type="string", example="Quintale II") */
    /** @OA\Property(property="bio", type="string", example="Bio description with details ...") */
    /** @OA\Property(property="email", type="string", example="frah.quintale2@gmail.com") */
    /** @OA\Property(property="password", type="string", example="secretpassword2") */
    /** @OA\Property(property="password_confirmation", type="string", example="secretpassword2") */

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:artists,id'],
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'last_name' => ['required', 'string', 'min:3', 'max:50'],
            'bio' => ['required', 'string',  'max:255'],
            'email' => ['required', 'unique:artists,email,' . $this->get('id')],
            'password' => ['required', 'min:5', 'max:25', 'confirmed'],
            'password_confirmation' => ['required', 'min:5', 'max:25']
        ];
    }

    public function getAttributes(): array
    {
        return array_merge(
            $this->only(['id', 'name', 'last_name', 'bio', 'email']),
            ['password' => Hash::make($this->get('password'))]
        );
    }
}
