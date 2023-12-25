<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            "avatar" => "required",
            "name" => "required|unique:users,name|max:255",
            "like_categories_ids" => 'required|array',
            'like_categories_ids.*' => 'integer|exists:categories,id',
        ];
    }

}
