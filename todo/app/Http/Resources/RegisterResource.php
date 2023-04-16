<?php

namespace App\Http\Resources;

use App\Const\RegisterConst;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    public function toArray($request)
    {
        if ($this->resource->status === 'error') {
            return [
                "resultcode" => RegisterConst::RESULTCODE_FAILED,
                "message" => RegisterConst::MESSAGE_FAILED
            ];
        }

        return [
            "resultcode" => RegisterConst::RESULTCODE_SUCCESS,
            "message" => RegisterConst::MESSAGE_SUCCESS
        ];
    }

    /**
     * 返却値のdataキーを省略
     *
     * @param RegisterReqest $request
     * @param Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        $response->setContent(json_encode($jsonResponse['data']));
    }
}
