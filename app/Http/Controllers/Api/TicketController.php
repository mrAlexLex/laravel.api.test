<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Api\Ticket;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $limit = (int)$request->get('limit', 100);
        $result = $this->model::with('messages')->paginate($limit);

        if (!$result) {
            return $this->sendError('Not Found', 404);
        }

        return TicketResource::collection($result);
    }

    /**
     * @param int $entityId
     * @return mixed
     */
    public function detail(int $entityId)
    {
        $entity = $this->model::with('messages')->find($entityId);

        if (!$entity) {
            return $this->sendError('Not Found', 404);
        }

        return new TicketResource($entity);
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
