<?php

namespace App\Http\Resources\swVersions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class swVersionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'swVersion',
                'attributes' => $this->collection
            ]
        ];
    }
}
