<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'project_id' );
            $table->string( 'type' )->default( 'MAIN_PO' );

            $table->unsignedBigInteger( 'vendor_id' )->nullable();
            $table->unsignedBigInteger( 'contact_id' );
            $table->unsignedInteger( 'sales_representative_id' );
            $table->unsignedInteger( 'approved_manager_id' )->nullable();
            $table->unsignedInteger( 'approval_requested_by' );
            $table->string( 'template_type' )->nullable();

            $table->string( 'title' );
            $table->string( 'quantity' );
            $table->string( 'trim_size' );

            $table->string( 'information_requests' )->nullable();
            $table->string( 'extent' )->nullable();
            $table->string( 'origination' )->nullable();
            $table->string( 'finishing_information' )->nullable();
            $table->string( 'packaging_information' )->nullable();
            $table->string( 'vendor_notes' )->nullable();
            $table->string( 'customer_shipping_to' )->nullable();

            $table->text( 'additional_comments' )->nullable();
            $table->unsignedInteger( 'remittance_id' )->nullable();
            $table->unsignedInteger( 'payment_term_id' )->nullable();

            $table->timestamp( 'fob_at' )->nullable();
            $table->timestamp( 'materials_in_at' )->nullable();
            $table->timestamp( 'delivery_at' )->nullable();
            $table->timestamp( 'approved_at' )->nullable();

            $table->timestamps();

            $table->foreign( 'contact_id' )
                  ->references( 'id' )
                  ->on( 'contacts' );

            $table->foreign( 'sales_representative_id' )
                  ->references( 'id' )
                  ->on( 'admin_users' );

            $table->foreign( 'vendor_id' )
                  ->references( 'id' )
                  ->on( 'vendors' )
                  ->onDelete( 'set null' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
