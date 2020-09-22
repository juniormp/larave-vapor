<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

/**
 * @property int $id
 */
class ListArtistMetricsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:artists'],
        ];
    }

    public function getAttributes(): array
    {
        return $this->only(['id']);
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            'id' => Route::input('id'),
        ]);
    }
}
