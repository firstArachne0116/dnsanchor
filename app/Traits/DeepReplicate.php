<?php

namespace App\Traits;

/**
 * Class DeepReplicate
 *
 * @package App\Traits
 */
trait DeepReplicate {

    /**
     *
     */
    public function replicate( $except = array() ) {
        $copy = $this->replicate();
        $copy->push(); // save to get an ID

        foreach ( $this->getRelations() as $relation => $entries ) {
            foreach ( $this->{$relation} as $entry ) {
                $e = $entry->replicate();

                if ( $e->push() ) {
                    $copy->{$relation}()->save( $e );
                }
            }
        }
    }

}