<?php

namespace App\Filters;

/**
 * Class FilterBuilder
 *
 * @package App\Filters
 */
class Filter {

    /**
     * @var
     */
    protected $name;

    /**
     * The field name within the database.
     *
     * @var
     */
    protected $field;

    /**
     * @var
     */
    protected $value;

    /**
     * @var
     */
    protected $filter_type;

    /**
     * @var array
     */
    protected $allowedFilters = [];

    /**
     * Filter constructor.
     *
     * @param       $name
     * @param       $field
     * @param array $allowedFilters
     */
    public function __construct( $name, $field, array $allowedFilters ) {
        $this->name           = $name;
        $this->allowedFilters = $allowedFilters;
        $this->field          = $field;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName( $name ) : void {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getField() {
        return $this->field;
    }

    /**
     * @param mixed $field
     */
    public function setField( $field ) : void {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getFilterType() {
        switch ( strtolower( $this->filter_type ) ) {
            case 'contains':
                return FilterBuilder::FILTER_OPERATION_CONTAINS;
            case 'does not contain':
                return FilterBuilder::FILTER_OPERATION_NOT_CONTAINS;
            case 'is equal to':
                return FilterBuilder::FILTER_OPERATION_EQUAL_TO;
            case 'is not equal to':
                return FilterBuilder::FILTER_OPERATION_NOT_EQUAL_TO;
        }
    }

    /**
     * @param mixed $filter_type
     */
    public function setFilterType( $filter_type ) : void {
        $this->filter_type = $filter_type;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue( $value ) : void {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getAllowedFilters() : array {
        return $this->allowedFilters;
    }

    /**
     * @param array $allowedFilters
     */
    public function setAllowedFilters( array $allowedFilters ) : void {
        $this->allowedFilters = $allowedFilters;
    }


}