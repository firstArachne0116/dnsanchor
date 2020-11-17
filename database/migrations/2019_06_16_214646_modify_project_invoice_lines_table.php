<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProjectInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'project_invoice_lines', function( Blueprint $table ) {
             $table->dropColumn( 'invoice_id' );
        });

        Schema::table( 'project_invoice_lines', function( Blueprint $table ) {
            $table->unsignedBigInteger( 'project_id' );

            $table->foreign( 'project_id' )
                  ->references( 'id' )
                  ->on( 'projects' );
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
