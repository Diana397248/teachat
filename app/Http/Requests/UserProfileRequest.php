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
//todo раскоментировать когда прикрутим автиоризацию
//        return false;
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
            //todo раскоментировать когда прикрутим автиоризацию
//            "name" => "required|unique:users,name," . $this->user->id . "|max:255",
            "name" => "required|unique:users,name," . 2 . "|max:255",
            "like_categories_ids" => 'present|array',
            'like_categories_ids.*' => 'integer|exists:categories,id',
        ];
    }

    //todo messages

}
