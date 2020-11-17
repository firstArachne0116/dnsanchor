<?php

namespace App\Filters;

use Illuminate\Http\Request;

/**
 * Class ContactFilter
 *
 * @package App\Filters
 */
class ContactFilter extends FilterBuilder {

    /**
     * @var
     */
    protected $query;

    /**
     * @var
     */
    protected $request;

    /**
     * ContactFilter constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $query
     */
    public function __construct( Request $request, $query ) {
        parent::__construct( $request, $query, [
            'contact_id' => new Filter( 'contact_id', 'id', [
                'contains',
                'does not contain',
                'is equal to',
                'is not equal to',
            ] ),

            'contact_name' => new Filter( 'contact_name', 'primary_contact_name', [
                'contains',
                'does not contain',
                'is equal to',
                'is not equal to',
            ] ),

            'company_name' => new Filter( 'company_name', 'company_name', [
                'contains',
                'does not contain',
                'is equal to',
                'is not equal to',
            ] ),
        ] );
    }

}