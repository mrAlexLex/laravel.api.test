<?php


namespace App\Http\Requests;


class TicketRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'uid' => 'required|string',
            'subject' => 'required|string',
            'user_name' => 'required|string',
            'user_email' => 'required|string'
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
