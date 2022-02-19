<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;

class IndexController extends Controller
{

    protected $createTicketService;

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->createTicketService = new TicketService();
    }

    public function index()
    {
        $response = $this->createTicketService->getAll();

        return view('ticket/index', [
            'tickets' => $response['success'] ? $response['data'] : null
        ]);
    }

    public function detail($id)
    {
        $response = $this->createTicketService->getOne($id);

        return view('ticket/detail', [
            'ticket' => $response['success'] ? $response['data'] : null
        ]);
    }

    public function create(TicketRequest $request)
    {
        $response = $this->createTicketService->create($request);

        if (isset($response['success']) && $response['success']) {
            $this->createTicketService->sendEmail($response);
            $this->createTicketService->sendRequest($response);

            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.create'))->withErrors([
            'formError' => 'Не удалось создать тикет'
        ]);
    }

    public function update(int $id, TicketRequest $request)
    {
        $response = $this->createTicketService->update($id, $request);

        if (isset($response['success']) && $response['success']) {
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.update', $id))->withErrors([
            'formError' => 'Не удалось обновить тикет'
        ]);

    }

    public function delete(int $id)
    {
        $response = $this->createTicketService->delete($id);

        if (isset($response) && $response['success']) {
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.tickets', $id))->withErrors([
            'formError' => 'Не удалось далить тикет'
        ]);
    }
}
