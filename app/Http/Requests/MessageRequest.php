<?php


namespace App\Http\Requests;


class MessageRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'author' => 'required|string',
            'content' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Обязательное поле для заполнения!',
            'content.required' => 'Обязательное поле для заполнения!'
        ];
    }

}
