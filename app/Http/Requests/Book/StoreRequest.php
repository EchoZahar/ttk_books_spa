<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'             => ['required', 'unique:books', 'string', 'max:150'],
            'author'            => ['required', 'min:3', 'max:150'],
            'description'       => ['required', 'string', 'max:2000'],
            'cover'             => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'year'              => ['required', 'numeric', 'digits:4' ],
            'country_of_birth'  => ['required', 'string', 'max:100'],
            'comments'          => ['required', 'string', 'max:500'],
        ];
    }
}
