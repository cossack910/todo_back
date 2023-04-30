<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "resultcode" => 0,
            "tasks" => $this->resource->tasks,
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
