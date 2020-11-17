<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyVendorsTableAddContactDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'vendors', function( Blueprint $table ) {
            // primary contact
            $table->string( 'primary_contact_name' )->nullable();
            $table->string( 'primary_contact_phone' )->nullable();
            $table->string( 'primary_contact_email' )->nullable();
            $table->text( 'primary_contact_address' )->nullable();
            $table->string( 'primary_contact_job_title' )->nullable();
            $table->string( 'primary_contact_status' )->nullable();

            // sales contact
            $table->string( 'sales_contact_name' )->nullable();
            $table->string( 'sales_contact_phone' )->nullable();
            $table->string( 'sales_contact_email' )->nullable();
            $table->text( 'sales_contact_address' )->nullable();
            $table->string( 'sales_contact_status' )->nullable();

            // design contact
            $table->string( 'design_contact_name' )->nullable();
            $table->string( 'design_contact_phone' )->nullable();
            $table->string( 'design_contact_email' )->nullable();
            $table->text( 'design_contact_address' )->nullable();
            $table->string( 'design_contact_status' )->nullable();

            // financial contact
            $table->string( 'financial_contact_name' )->nullable();
            $table->string( 'financial_contact_phone' )->nullable();
            $table->string( 'financial_contact_email' )->nullable();
            $table->text( 'financial_contact_address' )->nullable();
            $table->string( 'financial_contact_status' )->nullable();

            $table->foreign( 'sales_representative_id' )
                  ->references( 'id' )
                  ->on( 'admin_users' );
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
