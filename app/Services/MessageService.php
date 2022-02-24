<?php


namespace App\Services;


use App\Http\Requests\TicketRequest;
use App\Models\Reqres\ReqresCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class MessageService
 * @package App\Services
 */
class MessageService
{
    /**
     * @param string $message
     * @param string $uid
     */
    public function create(string $message, string $uid)
    {
        $requestMessage = [
            'author' => Auth::user()->access == 1 ? 'manager' : 'client',
            'content' => $message,
            'ticket_id' => $uid,
        ];

        Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->post('http://127.0.0.1:8001/api/v1/message/', $requestMessage)->json();
    }
}
