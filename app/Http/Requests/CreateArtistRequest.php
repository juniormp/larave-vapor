<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Schema(
 *      title="Create or Update Artist Request",
 *      type="object",
 *      required={"name", "last_name", "bio", "email", "password", "password_confirmation"}
 * )
 */
class CreateArtistRequest extends FormRequest
{

    /** @OA\Property(property="name", type="string", example="Frah") */
    /** @OA\Property(property="last_name", type="string", example="Quintale") */
    /** @OA\Property(property="bio", type="string", example="Bio description ...") */
    /** @OA\Property(property="email", type="string", example="frah.quintale@gmail.com") */
    /** @OA\Property(property="password", type="string", example="secretpassword") */
    /** @OA\Property(property="password_confirmation", type="string", example="secretpassword") */

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'last_name' => ['required', 'string', 'min:3', 'max:50'],
            'bio' => ['required', 'string',  'max:255'],
            'email' => ['required', 'unique:artists,email'],
            'password' => ['required', 'min:5', 'max:25', 'confirmed'],
            'password_confirmation' => ['required', 'min:5', 'max:25']
        ];
    }

    public function getAttributes(): array
    {
        return array_merge(
            $this->only(['name', 'last_name', 'bio', 'email']),
            ['password' => Hash::make($this->get('password'))]
        );
    }
}
