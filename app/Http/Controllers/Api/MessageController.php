<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\MessageRequest;
use App\Http\Requests\UserRequest;
use App\Models\Api\Message;
use App\Models\Api\Ticket;

class MessageController extends ApiControllers
{


    /**
     * TicketController constructor.
     */
    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    /**
     * @param MessageRequest $request
     * @return mixed
     */
    public function createMessage(MessageRequest $request)
    {
        return $this->create($request);
    }

    /**
     * @param int $entityId
     * @param MessageRequest $request
     * @return mixed
     */
    public function updateMessage(int $entityId, MessageRequest $request)
    {
        return $this->update($entityId, $request);
    }


}
