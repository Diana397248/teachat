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
        $user = auth('sanctum')->user();
        if ($user == null) {
            return false;
        }
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
            "name" => "required|unique:users,name," . $this->user()->id . "|max:255",
            "like_categories_ids" => 'present|array',
            'like_categories_ids.*' => 'integer|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'имя должно быть не пустым',
            'name.unique' => 'пользователь c таким именем уже занят',
        ];
    }

}
