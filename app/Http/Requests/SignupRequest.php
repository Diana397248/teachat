<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{

    //todo
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'имя должно быть не пустым',
            'name.string' => 'имя должно быть строкой',
            'last_name.required' => 'фамилия должна быть не пустым',
            'last_name.string' => 'фамилия должна быть строкой',
            'email.required' => 'email должен быть не пустым',
            'email.unique' => 'email уже зарегистрирован',
            'email.email' => 'вы должны ввести валидный email',
            'password.required' => 'пароль должен быть не пустым',
            'password.min' => 'минимальная длина пароля 1',
        ];
    }
}
