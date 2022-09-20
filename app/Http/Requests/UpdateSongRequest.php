<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSongRequest extends FormRequest
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
            'title' => 'string|max:100',
            'year' => 'integer|digits:4',
            'genre' => 'string|max:50',
            'artist' => 'string|max:100',
            'duration' => 'integer|min:0',
            'album_id' => 'integer|nullable|exists:albums,id',
        ];
    }
}
