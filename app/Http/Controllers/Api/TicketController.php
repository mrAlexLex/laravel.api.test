<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\TicketRequest;
use App\Models\Api\Ticket;

class TicketController extends ApiControllers
{
    /**
     * TicketController constructor.
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    /**
     * @param TicketRequest $request
     * @return mixed
     */
    public function createTicket(TicketRequest $request)
    {
        return $this->create($request);
    }

    /**
     * @param int $entityId
     * @param TicketRequest $request
     * @return mixed
     */
    public function updateTicket(int $entityId, TicketRequest $request)
    {
        return $this->update($entityId, $request);
    }


}
