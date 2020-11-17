<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailTemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray( $request );

        if ( $array[ 'header' ] === null ) {
            $array['header'] = '';
        }

        if ( $array[ 'body' ] === null ) {
            $array['body'] = '';
        }

        if ( $array[ 'footer' ] === null ) {
            $array['footer'] = '';
        }

        return $array;
    }
}
