<?php


namespace App\Models\Reqres;

use Illuminate\Support\Facades\Http;

/**
 * Class Reqres
 * @package App\Models\Reqres
 */
abstract class Reqres
{
    /**
     *
     */
    protected const url = '';
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var
     */
    protected $response;

    /**
     * @param $params
     */
    public function requestPost($params)
    {
        $this->response = Http::post(static::url, $params)->json();
    }

    /**
     * @return mixed
     */
    abstract public function save();
}
