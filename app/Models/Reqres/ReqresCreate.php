<?php


namespace App\Models\Reqres;


use Illuminate\Support\Facades\Log;

/**
 * Class ReqresCreate
 * @package App\Models\Reqres
 */
class ReqresCreate extends Reqres
{
    /**
     *
     */
    protected const url = 'https://reqres.in/api/users';
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @return mixed|void
     */
    public function save()
    {
        Log::info('request user', $this->response);
    }
}
