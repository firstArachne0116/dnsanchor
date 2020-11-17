<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string( 'type' );
            $table->unsignedInteger( 'sales_representative_id' );
            $table->unsignedBigInteger( 'category_id' )->nullable();

            // primary contact
            $table->string( 'primary_contact_name' )->nullable();
            $table->string( 'primary_contact_phone' )->nullable();
            $table->string( 'primary_contact_email' )->nullable();
            $table->text( 'primary_contact_address' )->nullable();
            $table->string( 'primary_contact_job_title' )->nullable();
            $table->string( 'primary_contact_status' )->nullable();

            // secondary contact
            $table->string( 'secondary_contact_name' )->nullable();
            $table->string( 'secondary_contact_phone' )->nullable();
            $table->string( 'secondary_contact_email' )->nullable();
            $table->text( 'secondary_contact_address' )->nullable();
            $table->string( 'secondary_contact_job_title' )->nullable();
            $table->string( 'secondary_contact_status' )->nullable();

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

            // company details
            $table->string( 'company_name' )->nullable();
            $table->string( 'company_phone' )->nullable();
            $table->text( 'company_address' )->nullable();

            $table->text( 'shipping_address' )->nullable();
            $table->string( 'website' )->nullable();
            $table->text( 'social_media' )->nullable();

            $table->string( 'source' )->nullable();
            $table->unsignedInteger( 'referred_by' )->nullable();

            $table->timestamps();

            $table->foreign( 'sales_representative_id' )
                ->references( 'id' )
                ->on( 'admin_users' );

            $table->foreign( 'category_id' )
                ->references( 'id' )
                ->on( 'customer_categories' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
