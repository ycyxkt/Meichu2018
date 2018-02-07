<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: 檢查是否有權限
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
            'date' => 'date|before:"2018-03-05"|after:"2018-03-01"',
            'score_nthu' => 'nullable|numeric',
            'score_nctu' => 'nullable|numeric',
            'score_draw' => 'nullable|numeric',
            'broadcast_url' => 'nullable|url',
            'vr360_url' => 'nullable|url',
            'location_url' => 'url',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
        ];
    }
}
