<?php


namespace App\Models\Reqres;

use Illuminate\Support\Facades\Http;

abstract class Reqres
{
    protected const url = '';
    protected $params = [];
    protected $response;

    public function requestPost($params)
    {
        $this->response = Http::post(static::url, $params)->json();
    }

    abstract public function save();
}
