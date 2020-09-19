<?php

namespace App\Http\Requests;

use App\Domain\Prize\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CreateOrUpdatePrizeRequest extends FormRequest
{

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
