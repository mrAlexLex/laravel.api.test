<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Jobs\SendEmail;
use App\Services\MessageService;
use App\Services\TicketService;

/**
 * Class IndexController
 * @package App\Http\Controllers\Pages
 */
class IndexController extends Controller
{

    /**
     * @var TicketService
     */
    protected $ticketService;
    protected $messageService;


    /**
     * IndexController constructor.
     * @param TicketService $ticketService
     */
    public function __construct(TicketService $ticketService, MessageService $messageService)
    {
        $this->ticketService = $ticketService;
        $this->messageService = $messageService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $response = $this->ticketService->getAll();

        return view('ticket/index', [
            'tickets' => $response['success'] ? $response['data'] : null
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id)
    {
        $response = $this->ticketService->getOne($id);

        return view('ticket/detail', [
            'ticket' => $response['success'] ? $response['data'] : null
        ]);
    }

    /**
     * @param TicketRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(TicketRequest $request)
    {
        $response = $this->ticketService->create($request);

        if (isset($response['success']) && $response['success']) {
            $this->ticketService->sendRequest($response);
            $this->messageService->create($request->get('message'), $response['data']['uid']);

            $job = (new SendEmail($request));
            $this->dispatch($job);

            return redirect(route('tickets.tickets'))->with('message', 'Тикет успешно добавлен!');
        }

        return redirect(route('tickets.create'))->withErrors([
            'formError' => 'Не удалось создать тикет'
        ]);
    }

    /**
     * @param int $id
     * @param TicketRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(int $id, TicketRequest $request)
    {
        $response = $this->ticketService->update($id, $request);

        if (isset($response['success']) && $response['success']) {
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.update', $id))->withErrors([
            'formError' => 'Не удалось обновить тикет'
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id)
    {
        $response = $this->ticketService->delete($id);

        if (isset($response) && $response['success']) {
            return redirect(route('tickets.tickets'));
        }

        return redirect(route('tickets.tickets', $id))->withErrors([
            'formError' => 'Не удалось далить тикет'
        ]);
    }
}
