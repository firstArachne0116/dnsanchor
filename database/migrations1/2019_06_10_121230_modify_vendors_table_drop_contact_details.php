<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyVendorsTableDropContactDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'vendors', function( Blueprint $table ) {
            $table->dropColumn( 'primary_first_name' );
            $table->dropColumn( 'primary_last_name' );
            $table->dropColumn( 'primary_email' );
            $table->dropColumn( 'primary_phone' );
            $table->dropColumn( 'primary_position' );
            $table->dropColumn( 'financial_contact_name' );
            $table->dropColumn( 'technical_contact_name' );
            $table->dropColumn( 'sales_contact_name' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
