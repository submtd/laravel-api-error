<?php

namespace Submtd\LaravelApiError\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ErrorCollection extends ResourceCollection
{
    /**
     * To array.
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ErrorResource::collection($this->collection),
        ];
    }
}
