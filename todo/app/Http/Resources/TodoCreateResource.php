<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoCreateResource extends JsonResource
{
    public function toArray($request)
    {

        if ($this->resource->status === 'error') {
            return [
                "resultcode" => 99,
                "message" => 'Bad request. Invalid input data.'
            ];
        }

        return [
            "resultcode" => 0,
            "user_id" => $this->resource->task["user_id"],
            "title" => $this->resource->task["title"],
            "description" => $this->resource->task["description"],
            "category" => $this->resource->task["category"],
            "priority" => $this->resource->task["priority"],
            "due_date" => $this->resource->task["due_date"],
            "completed" => $this->resource->task["completed"],
            "created_at" => $this->resource->task["created_at"],
            "updated_at" => $this->resource->task["updated_at"],
        ];
    }

    /**
     * 返却値のdataキーを省略
     *
     * @param LoginRequest $request
     * @param Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        $response->setContent(json_encode($jsonResponse['data']));
    }
}
