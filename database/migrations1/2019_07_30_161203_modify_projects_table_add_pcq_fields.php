<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProjectsTableAddPcqFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'projects', function( Blueprint $table ) {
            $table->text( 'additional_comments' )->nullable();
            $table->unsignedInteger( 'remittance_id' )->nullable();
            $table->unsignedInteger( 'payment_term_id' )->nullable();
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
