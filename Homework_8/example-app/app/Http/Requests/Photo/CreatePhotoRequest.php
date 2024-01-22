<?php

namespace App\Http\Requests\Photo;

use App\Models\Photo;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreatePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:64',
            'tags' => 'array',
            'tags.*' => 'exists:photo_tags,id',
            'category_id' => 'required|exists:photo_categories,id',
            'user_id' => 'required|exists:users,id',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:8096'
        ];
    }

    // Если возникает ошибка валидации
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(['errors' => $validator->errors()], 422);

        throw new ValidationException($validator, $response);
    }

    public function getModelFromRequest() : Photo
    {
        return new Photo(($this->all()));
    }
}
