<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger( 'sales_representative_id' );
            $table->unsignedInteger( 'category_id' )->nullable();
            $table->string( 'name' );
            $table->string( 'phone' )->nullable();
            $table->string( 'fax' )->nullable();
            $table->string( 'website' )->nullable();
            $table->string( 'primary_first_name' )->nullable();
            $table->string( 'primary_last_name' )->nullable();
            $table->string( 'primary_email' )->nullable();
            $table->string( 'primary_phone' )->nullable();
            $table->string( 'primary_position' )->nullable();
            $table->string( 'financial_contact_name' )->nullable();
            $table->string( 'technical_contact_name' )->nullable();
            $table->string( 'sales_contact_name' )->nullable();
            $table->string( 'suite' )->nullable();
            $table->string( 'billing_address_street' )->nullable();
            $table->string( 'billing_address_city' )->nullable();
            $table->string( 'billing_address_state' )->nullable();
            $table->string( 'billing_address_zip_code' )->nullable();
            $table->string( 'billing_address_country' )->nullable();
            $table->text( 'notes' );
            $table->timestamps();

            $table->foreign( 'sales_representative_id' )
                  ->references( 'id' )
                  ->on( 'users' );

            $table->foreign( 'category_id' )
                ->references( 'id' )
                ->on( 'vendor_categories' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
