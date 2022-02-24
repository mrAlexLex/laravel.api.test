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
class TicketService
{
    /**
     * @return array|mixed
     */
    public function getAll()
    {
        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->get('http://127.0.0.1:8001/api/v1/tickets')->json();

    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getOne(int $id)
    {
        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->get('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();
    }

    /**
     * @param TicketRequest $request
     * @return array|mixed
     */
    public function create(TicketRequest $request)
    {
        $validateFields = $request->validated();
        $validateFields['uid'] = (string)Str::uuid();

        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->post('http://127.0.0.1:8001/api/v1/tickets/', $validateFields)->json();
    }

    /**
     * @param int $id
     * @param TicketRequest $request
     * @return array|mixed
     */
    public function update(int $id, TicketRequest $request)
    {
        $validateFields = $request->validated();

        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->put('http://127.0.0.1:8001/api/v1/tickets/' . $id, $validateFields)->json();
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function delete(int $id)
    {
        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->delete('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();
    }

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
