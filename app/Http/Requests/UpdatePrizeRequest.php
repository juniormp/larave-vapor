<?php

namespace App\Http\Requests;

use App\Domain\Prize\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      title="Update Prize Request",
 *      type="object",
 *      required={"id", "name", "category", "description", "image", "artist_id"}
 * )
 */
class UpdatePrizeRequest extends FormRequest
{
    /** @OA\Property(property="id", type="string", example="1") */
    /** @OA\Property(property="name", type="string", example="Ticket - 2") */
    /** @OA\Property(property="category", type="string", example="FIRST") */
    /** @OA\Property(property="description", type="string", example="Show tickets for the first in monthly rank - 2") */
    /** @OA\Property(property="image", type="string", example="d879f8f89b1bbf") */
    /** @OA\Property(property="artist_id", type="string", example="1") */

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:prizes'],
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'category' => ['required', Rule::in(Category::$categories)],
            'description' => ['required', 'string', 'max:250'],
            'image' => ['required', 'string'],
            'artist_id' => ['required', 'int', 'exists:artists,id']
        ];
    }

    public function getAttributes(): array
    {
        return $this->only(['id', 'name', 'category', 'description', 'image', 'artist_id']);
    }
}
