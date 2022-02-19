<?php


namespace App\Services;


use App\Http\Requests\TicketRequest;
use App\Mail\ApiMail;
use App\Models\Reqres\ReqresCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketService
{
    public function getAll()
    {
        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->get('http://127.0.0.1:8001/api/v1/tickets')->json();

        /*
         *
         * Обработка ответа API
         *
         */
    }

    public function getOne(int $id)
    {
        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->get('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();

        /*
         *
         * Обработка ответа API
         *
         */
    }

    public function create(TicketRequest $request)
    {
        $validateFields = $request->validated();
        $validateFields['uid'] = (string)Str::uuid();

        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->post('http://127.0.0.1:8001/api/v1/tickets/', $validateFields)->json();
    }

    public function update(int $id, TicketRequest $request)
    {
        $validateFields = $request->validated();

        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->put('http://127.0.0.1:8001/api/v1/tickets/' . $id, $validateFields)->json();
    }

    public function delete(int $id)
    {
        return Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->delete('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();
    }

    public function sendEmail($response)
    {
        Mail::to($response['data']['user_email'])->send(new ApiMail('from@example.com'));
    }

    public function sendRequest($response)
    {
        $reqresResponse = new ReqresCreate();
        $reqresResponse->requestPost($response);
        $reqresResponse->save();
    }
}
