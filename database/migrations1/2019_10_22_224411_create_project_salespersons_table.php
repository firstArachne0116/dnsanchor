<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSalespersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_salespersons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'project_id' );
            $table->unsignedInteger( 'salesperson_id' );

            $table->foreign( 'project_id' )
                ->references( 'id' )
                ->on( 'projects' )
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
