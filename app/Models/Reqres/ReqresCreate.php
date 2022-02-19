<?php


namespace App\Models\Reqres;


use Illuminate\Support\Facades\Log;

class ReqresCreate extends Reqres
{
    protected const url = 'https://reqres.in/api/users';
    protected $params = [];

    public function save()
    {
        Log::info('request user', $this->response);
    }
}
