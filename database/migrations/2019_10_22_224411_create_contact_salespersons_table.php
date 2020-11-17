<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactSalespersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_salespersons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'contact_id' );
            $table->unsignedInteger( 'salesperson_id' );

            $table->foreign( 'contact_id' )
                ->references( 'id' )
                ->on( 'contacts' )
                ->onDelete( 'cascade' );

            $table->foreign( 'salesperson_id' )
                ->references( 'id' )
                ->on( 'admin_users' )
                ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_salespersons');
    }
}
