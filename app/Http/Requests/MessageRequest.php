<?php


namespace App\Http\Requests;


class MessageRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'author' => 'required|string',
            'content' => 'required|string',
            'ticket_id' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Обязательное поле для заполнения!',
            'content.required' => 'Обязательное поле для заполнения!',
            'ticket_id.required' => 'Обязательное поле для заполнения!'
        ];
    }

}
