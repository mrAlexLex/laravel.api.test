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
        $offset = (int)$request->get('offset', 0);
        $result = $this->model::with('messages')->limit($limit)->offset($offset)->get();

        if (!$result) {
            return $this->sendError('Not Found', 404);
        }

        return $this->sendResponse(TicketResource::collection($result), 'OK', 200);
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

        return $this->sendResponse(new TicketResource($entity), 'OK', 200);
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
