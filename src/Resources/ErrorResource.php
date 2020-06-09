<?php

namespace Submtd\LaravelApiError\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * To Array.
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'error',
            'id' => $this->uuid,
            'attributes' => [
                'uri' => $this->uri,
                'request' => $this->request,
                'request_headers' => $this->request_headers,
                'message' => $this->message,
                'code' => $this->code,
            ],
            'links' => [
                'self' => url(route('api-error.show', ['uuid' => $this->uuid])),
            ],
        ];
    }
}
