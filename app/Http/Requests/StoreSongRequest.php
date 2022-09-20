<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSongRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'year' => 'required|integer|digits:4',
            'genre' => 'required|string|max:50',
            'artist' => 'required|string|max:100',
            'duration' => 'integer|min:0',
            'album_id' => 'integer|nullable|exists:albums,id',
        ];
    }
}
