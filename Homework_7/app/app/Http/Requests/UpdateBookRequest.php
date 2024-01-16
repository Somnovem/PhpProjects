<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Book;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:1|max:100',
            'author' => 'required|min:1|max:100',
            'description' => 'nullable|min:0|max:1000',
            'page_count' => 'nullable|integer',
            'year_published' => 'nullable|integer',
        ];
    }

    public function updateModel(Book $book): Book
    {
        $book->update($this->all());
        return $book;
    }
}
