<?php


namespace App\Http\Requests;


class UserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'ftp_login' => 'required|unique:users|string|min:4|max:50|regex:/^\S*$/u',
            'ftp_password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'ftp_login.required' => 'Обязательное поле для заполнения!',
            'ftp_password.required' => 'Обязательное поле для заполнения!'
        ];
    }

}
