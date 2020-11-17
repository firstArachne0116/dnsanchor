<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray( $request ) {
        $array = parent::toArray( $request );

        if ( isset( $array[ 'sales_persons' ] ) ) {
            $array[ 'assigned_salesperson' ] = $this->sales_persons->map( function( $item ) use( $request ) {
                return ( new SalesPersonResource( $item ) )->toArray( $request );
            });
        }
        
        if ( ! isset( $array[ 'primary_contact_communication_preferences' ] ) ) {
            $array[ 'primary_contact_communication_preferences' ] = [];
        }

        if ( ! isset( $array[ 'secondary_contact_communication_preferences' ] ) ) {
            $array[ 'secondary_contact_communication_preferences' ] = [];
        }

        if ( ! isset( $array[ 'sales_contact_communication_preferences' ] ) ) {
            $array[ 'sales_contact_communication_preferences' ] = [];
        }

        if ( ! isset( $array[ 'design_contact_communication_preferences' ] ) ) {
            $array[ 'design_contact_communication_preferences' ] = [];
        }
        
        if ( ! isset( $array[ 'financial_contact_communication_preferences' ] ) ) {
            $array[ 'financial_contact_communication_preferences' ] = [];
        }
        
        return $array;
    }
}
