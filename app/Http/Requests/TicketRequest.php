<?php


namespace App\Http\Requests;


class TicketRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'uid' => 'required|string|unique:ticket',
            'subject' => 'required|string|min:10',
            'user_name' => 'required|string|min:10|max:100|regex:/^\S*$/u',
            'user_email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'uid.required' => 'Обязательное поле для заполнения!',
            'subject.required' => 'Обязательное поле для заполнения!',
            'user_name.required' => 'Обязательное поле для заполнения!',
            'user_email.required' => 'Обязательное поле для заполнения!'
        ];
    }

}
