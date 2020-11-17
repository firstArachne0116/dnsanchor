<?php

namespace App\Http\Resources;

use function App\Helpers\get_invoice_line_items;
use App\Models\ProjectInvoiceLine;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);

        $causer_ids = $this->contributors->map( function ( $item ) {
            return $item->causer_id;
        } );

        if ( isset( $array[ 'sales_persons' ] ) ) {
            $array[ 'assigned_salesperson' ] = $this->sales_persons->map( function ( $item ) use ( $request ) {
                return ( new SalesPersonResource( $item ) )->toArray( $request );
            } );
        }

        $array[ 'contributors' ] = \App\Http\Resources\AdminUserResource::collection( \App\Models\AdminUser::whereIn( 'id', $causer_ids )->get() );

        return $array;
    }
}
