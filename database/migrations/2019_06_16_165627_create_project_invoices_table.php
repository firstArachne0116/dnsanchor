<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'project_id' );
            $table->timestamp( 'approved_at' )->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('project_invoices');
    }
}
