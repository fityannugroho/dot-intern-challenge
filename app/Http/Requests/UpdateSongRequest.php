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
            'year' => 'required|integer|digits:4|min:1901|max:' . date('Y'),
            'genre' => 'string|max:50',
            'artist' => 'string|max:100',
            'duration' => 'integer|min:0',
            'album_id' => 'integer|nullable|exists:albums,id',
        ];
    }

    protected function prepareForValidation()
    {
        // Convert the duration to seconds.
        $duration = $this->get('duration');
        $duration = explode(':', $duration);
        $duration = count($duration) > 2
            ? $duration[0] * 60 * 60 + $duration[1] * 60 + $duration[2]
            : $duration[0] * 60 + $duration[1];

        $this->merge([
            'duration' => $duration,
        ]);
    }
}
