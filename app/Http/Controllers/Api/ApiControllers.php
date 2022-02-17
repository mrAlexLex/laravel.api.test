<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class ApiControllers extends Controller
{
    protected $request;
    protected $model;

    public function get(Request $request)
    {
        $limit = (int)$request->get('limit', 100);
        $offset = (int)$request->get('offset', 0);
        $result = $this->model->limit($limit)->offset($offset)->get();

        if (!$result) {
            return $this->sendError('Not Found', 404);
        }

        return $this->sendResponse($result, 'OK', 200);
    }

    public function detail(int $entityId)
    {
        $entity = $this->model->find($entityId)->first();

        if (!$entity) {
            return $this->sendError('Not Found', 404);
        }

        return $this->sendResponse($entity, 'OK', 200);
    }

    public function create(Request $request)
    {
        $data = $request->validated();
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->model->fill($data)->push();

        return $this->sendResponse(null, 'Created', 201);
    }

    public function update(int $entityId, Request $request)
    {
        $entity = $this->model::find($entityId);

        if (!$entity) {
            return $this->sendError('Not Found', 404);
        }

        $data = $request->validated();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $entity->fill($data)->save();

        return $this->sendResponse(null, 'Updated', 204);
    }

    public function delete(int $entityId = null)
    {
        $entity = $this->model->find($entityId);

        if (!$entity) {
            return $this->sendError('Not Found', 404);
        }

        $entity->delete();

        return $this->sendResponse(null, 'Deleted', 204);
    }
}
