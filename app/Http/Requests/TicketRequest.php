<?php


namespace App\Http\Requests;


class TicketRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'uid' => 'string|unique:ticket',
            'subject' => 'required|string|min:6',
            'user_name' => 'required|string|min:3|max:100|regex:/^\S*$/u',
            'user_email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Обязательное поле для заполнения!',
            'user_name.required' => 'Обязательное поле для заполнения!',
            'user_email.required' => 'Обязательное поле для заполнения!'
        ];
    }

}
