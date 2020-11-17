<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger( 'contact_id' );
            $table->unsignedInteger( 'sales_representative_id' );

            $table->string( 'title' );
            $table->string( 'quantity' );
            $table->string( 'trim_size' );
            $table->string( 'extent' );
            $table->string( 'orientation' );

            $table->text( 'finishing_information' )->nullable();
            $table->text( 'packaging_information' )->nullable();
            $table->text( 'origination' )->nullable();
            $table->text( 'information_requests' )->nullable();
            $table->text( 'customer_shipping_to' )->nullable();

            $table->json( 'project_type' )->nullable();

            $table->timestamp( 'fob_at' )->nullable();
            $table->timestamp( 'materials_in_at' )->nullable();
            $table->timestamp( 'delivery_at' )->nullable();

            $table->timestamps();

            $table->foreign( 'contact_id' )
                ->references( 'id' )
                ->on( 'contacts' );

            $table->foreign( 'book_id' )
                ->references( 'id' )
                ->on( 'books' );

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
        Schema::dropIfExists('projects');
    }
}
