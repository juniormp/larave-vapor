<?php

namespace App\Http\Requests;

use App\Domain\Prize\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      title="Create or Update Prize Request",
 *      type="object",
 *      required={"name", "category", "description", "image", "artist_id"}
 * )
 */
class UpdatePrizeRequest extends FormRequest
{
    /** @OA\Property(property="id", type="string", example="1") */
    public $id;

    /** @OA\Property(property="name", type="string", example="Ticket") */
    private $name;

    /** @OA\Property(property="category", type="string", example="FIRST") */
    private $category;

    /** @OA\Property(property="description", type="string", example="Show tickets for the first in monthly rank") */
    private $description;

    /** @OA\Property(property="image", type="string", example="d879f8f89b1bbf") */
    private $image;

    /** @OA\Property(property="artist_id", type="string", example="1") */
    private $artist_id;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['nullable', 'filled', 'integer', 'exists:prizes'],
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
