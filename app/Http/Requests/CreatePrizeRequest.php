<?php

namespace App\Http\Requests;

use App\Domain\Prize\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      title="Create Prize Request",
 *      type="object",
 *      required={"name", "category", "description", "image", "artist_id"}
 * )
 */
class CreatePrizeRequest extends FormRequest
{

    /** @OA\Property(property="name", type="string", example="Ticket") */
    /** @OA\Property(property="category", type="string", example="FIRST") */
    /** @OA\Property(property="description", type="string", example="Show tickets for the first in monthly rank") */
    /** @OA\Property(property="image", type="string", example="d879f8f89b1bbf") */
    /** @OA\Property(property="artist_id", type="string", example="1") */

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'category' => ['required', Rule::in(Category::$categories)],
            'description' => ['required', 'string', 'max:250'],
            'image' => ['required', 'string'],
            'artist_id' => ['required', 'int', 'exists:artists,id']
        ];
    }

    public function getAttributes(): array
    {
        return $this->only(['name', 'category', 'description', 'image', 'artist_id']);
    }
}
