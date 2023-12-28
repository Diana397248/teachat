<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'category_id' => 'required|exists:App\Models\Category,id',
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'type' => 'in:img,video',
//           TODO фаил
            'content_data' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'должно быть не пустым',
            'category_id.exists' => 'нет такой категории',
            'title.required' => 'должно быть не пустым',
            'title.max' => 'привышена максимальное количество символов 255',
            'description.required' => 'должно быть не пустым',
            'description.max' => 'привышена максимальное количество символов 255',
            'type.in' => 'тип должен быть img или video',
//           TODO фаил
//            'content_data.required' => 'required',
        ];
    }
}
