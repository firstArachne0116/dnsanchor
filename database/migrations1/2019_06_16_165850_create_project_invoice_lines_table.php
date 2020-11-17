<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_invoice_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger( 'invoice_id' );
            $table->string( 'name' );
            $table->text( 'description' );
            $table->float( 'quantity' );
            $table->string( 'unit_cost' );
            $table->string( 'unit_price' );
            $table->timestamp( 'approved_at' )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_invoice_line');
    }
}
