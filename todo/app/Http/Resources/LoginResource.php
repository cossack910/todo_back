<?php

namespace App\Http\Resources;

use App\Const\LoginConst;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        if ($this->resource->status === 'error') {
            return [
                "resultcode" => LoginConst::RESULTCODE_FAILED,
                "message" => LoginConst::MESSAGE_FAILED
            ];
        }

        return [
            "resultcode" => LoginConst::RESULTCODE_SUCCESS,
            "message" => LoginConst::MESSAGE_SUCCESS,
            "token" => $this->resource->token,
            "token_type" => "Bearer",
            "expires_in" => 3600
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
