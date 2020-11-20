<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProjectsTableAlterCsrNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'projects', function ( Blueprint $table ) {
            $table->dropColumn( 'csr' );
        });
        Schema::table( 'projects', function ( Blueprint $table ) {
            $table->string( 'csr' )->nullable();
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
