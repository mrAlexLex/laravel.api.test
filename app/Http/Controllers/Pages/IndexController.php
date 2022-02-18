<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{

    public function index()
    {
        $response = Http::withHeaders([
            'x-api-key' => 'asd2343asdasaYdnnas89932asdasd'
        ])->get('http://127.0.0.1:8001/api/v1/tickets')->json();

        return view('ticket/index', [
            'tickets' => $response['success'] ? $response['data'] : null
        ]);
    }

    public function detail($id)
    {
        $response = Http::withHeaders([
            'x-api-key' => 'asd2343asdasaYdnnas89932asdasd'
        ])->get('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();

        return view('ticket/detail', [
            'ticket' => $response['success'] ? $response['data'] : null
        ]);
    }

    public function create(Request $request)
    {
        $validateFields = $request->validate([
            'subject' => 'required|string',
            'user_name' => 'required|string',
            'user_email' => 'required|email',
        ]);

        $validateFields['uid'] = 'fdsge';//брать у пользователя
        //проверка на существование записи

        $response = Http::withHeaders([
            'x-api-key' => 'asd2343asdasaYdnnas89932asdasd'//брать у пользователя
        ])->post('http://127.0.0.1:8001/api/v1/tickets/', $validateFields)->json();


        if (isset($response['success']) && $response['success']){
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.create'))->withErrors([
            'formError' => 'Не удалось создать тикет'
        ]);
    }

    public function update(int $id, Request $request)
    {
        $validateFields = $request->validate([
            'subject' => 'required|string',
            'user_name' => 'required|string',
            'user_email' => 'required|email',
        ]);

        $validateFields['uid'] = 'dasd223';//брать у пользователя

        $response = Http::withHeaders([
            'x-api-key' => 'asd2343asdasaYdnnas89932asdasd'//брать у пользователя
        ])->put('http://127.0.0.1:8001/api/v1/tickets/' . $id, $validateFields)->json();

        if (isset($response['success']) && $response['success']){
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.update', $id))->withErrors([
            'formError' => 'Не удалось обновить тикет'
        ]);

    }

    public function delete(int $id)
    {
        $response = Http::withHeaders([
            'x-api-key' => 'asd2343asdasaYdnnas89932asdasd'//брать у пользователя
        ])->delete('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();

        if (isset($response) && $response['success']){
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.tickets', $id))->withErrors([
            'formError' => 'Не удалось далить тикет'
        ]);
    }
}
