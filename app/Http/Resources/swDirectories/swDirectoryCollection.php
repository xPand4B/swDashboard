<?php

namespace App\Http\Resources\swDirectories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class swDirectoryCollection extends ResourceCollection
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
                'type' => 'swDirectory',
                'attributes' => $this->collection
            ]
        ];
    }
}
