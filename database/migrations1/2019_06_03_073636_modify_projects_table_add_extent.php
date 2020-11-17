<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProjectsTableAddExtent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'projects', function( Blueprint $table ) {
            $table->string( 'information_requests' )->nullable();
            $table->string( 'extent' )->nullable();
            $table->string( 'origination' )->nullable();
            $table->string( 'finishing_information' )->nullable();
            $table->string( 'packaging_information' )->nullable();
            $table->string( 'vendor_notes' )->nullable();
            $table->string( 'customer_shipping_to' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'projects', function ( Blueprint $table ) {
            $table->removeColumn( 'extent' );
            $table->removeColumn( 'origination' );
            $table->removeColumn( 'finishing_information' );
            $table->removeColumn( 'packaging_information' );
            $table->removeColumn( 'vendor_notes' );
            $table->removeColumn( 'customer_shipping_to' );
        } );
    }
}
