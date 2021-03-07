<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectInvoiceAllIncludeOnSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'project_invoice_lines', function ( Blueprint $table ) {
            $table->boolean( 'include_on_sales' )->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'project_invoice_lines', function ( Blueprint $table ) {
            $table->dropColumn( 'include_on_sales' );
        });
    }
}
