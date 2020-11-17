<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesPersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID' => $this->id,
            'forename' => $this->first_name,
            'full_name' => $this->full_name,
            'surname' => $this->last_name,
            'name' => sprintf( '%s %s', $this->first_name, $this->last_name ),
        ];
    }
}
