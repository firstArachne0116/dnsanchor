<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorSalespersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_salespersons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'vendor_id' );
            $table->unsignedInteger( 'salesperson_id' );

            $table->foreign( 'vendor_id' )
                ->references( 'id' )
                ->on( 'vendors' )
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
        Schema::dropIfExists('vendor_salespersons');
    }
}
