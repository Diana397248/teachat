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
//            'avatar' => 'required|mimes:jpg,jpeg,png|max:2048',
            "name" => "required|unique:users,name," . $this->user()->id . "|max:255",
        ];
    }

    public function messages()
    {
        return [
            //todo avatar
            'name.required' => 'имя должно быть не пустым',
            'name.unique' => 'пользователь c таким именем уже занят',
        ];
    }

}
