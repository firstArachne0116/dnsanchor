<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProjectsTableAddStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'projects', function ( Blueprint $table ) {
            $table->enum( 'status', [
                'AWAITING_MANAGER_APPROVAL',
                'OFFICIAL_VERSION',
                'DRAFT_VERSION',
                'DELETED',
                'REJECTED',
            ] )->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'projects', function( Blueprint $table ) {
            $table->removeColumn( 'status' );
        });
    }
}
