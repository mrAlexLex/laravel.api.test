<?php


namespace App\Services;


use App\Http\Requests\TicketRequest;
use App\Models\Reqres\ReqresCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class TicketService
 * @package App\Services
 */
class ReqresService
{

    /**
     * @param $response
     */
    public function sendRequest($response)
    {
        $reqresResponse = new ReqresCreate();
        $reqresResponse->requestPost($response);
        $reqresResponse->save();
    }
}
