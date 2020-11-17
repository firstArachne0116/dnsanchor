<?php

namespace App\Filters;

use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * Class FilterBuilder
 *
 * @package App\Filters
 */
class FilterBuilder {

    /**
     *
     */
    const FILTER_OPERATION_CONTAINS = 'contains';
    /**
     *
     */
    const FILTER_OPERATION_NOT_CONTAINS = 'not_contains';
    /**
     *
     */
    const FILTER_OPERATION_NOT_EQUAL_TO = 'not_equal_to';
    /**
     *
     */
    const FILTER_OPERATION_EQUAL_TO = 'equal_to';

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $filterOptions = [];

    /**
     * FilterBuilder constructor.
     *
     * @param $request Request
     * @param $query \Illuminate\Database\Eloquent\Builder
     */
    public function __construct( Request $request, $query, $filterOptions = null ) {
        $this->request = $request;
        $this->query = $query;
        $this->filterOptions = $filterOptions;
    }

    /**
     * @param \App\Filters\Filter $filter
     */
    public function apply( Filter $filter ) {
        switch ( $filter->getFilterType() ) {
            case self::FILTER_OPERATION_EQUAL_TO:
                $this->query->where( $filter->getField(), '=', $filter->getValue() );
                break;
            case self::FILTER_OPERATION_NOT_EQUAL_TO:
                $whereNull = $this->query->getModel()->newModelQuery()->whereNull( $filter->getField() );
                $this->query->where( $filter->getField(), '!=', $filter->getValue() )->union( $whereNull );
                break;
            case self::FILTER_OPERATION_CONTAINS:
                $this->query->where( $filter->getField(), 'LIKE', '%' . $filter->getValue() . '%' );
                break;
            case self::FILTER_OPERATION_NOT_CONTAINS:
                $this->query->where( $filter->getField(), 'NOT LIKE', '%' . $filter->getValue() . '%' );
                break;
        }
    }

    /**
     *
     */
    public function filter() {
        foreach ( $this->filterOptions as $key => $filterOption ) {
            if ( $this->request->has( $key ) ) {
                $filter = $this->getFilterObject( $key );
                $this->apply( $filter );
            }
        }
    }


    /**
     * @param $input_key
     *
     * @return bool|\App\Filters\Filter
     */
    private function getFilterObject( $input_key ) {
        if ( isset( $this->filterOptions[ $input_key ] ) ) {
            if ( $filter_type = $this->request->input( $input_key . '.option' ) ) {
                $this->filterOptions[ $input_key ]->setFilterType( $filter_type );
            }

            if ( $value = $this->request->input( $input_key . '.value' ) ) {
                $this->filterOptions[ $input_key ]->setValue( $value );
            }

            return $this->filterOptions[ $input_key ];
        }

        return false;
    }

    /**
     * @return array|null
     */
    private function getFilterOptions() {
        return $this->filterOptions;
    }
}