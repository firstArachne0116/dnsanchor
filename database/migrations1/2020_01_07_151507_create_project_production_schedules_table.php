<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectProductionSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_production_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp( 'files_in' )->nullable();
            $table->timestamp( 'proofs_ozalids_out' )->nullable();
            $table->timestamp( 'proof_ozalid_approval' )->nullable();
            $table->timestamp( 'printed_sheets_out' )->nullable();
            $table->timestamp( 'printed_sheets_approval' )->nullable();
            $table->timestamp( 'advanced_cps_out' )->nullable();
            $table->timestamp( 'advanced_cps_approval' )->nullable();
            $table->timestamp( 'ex_factory' )->nullable();
            $table->timestamp( 'bulk_loading' )->nullable();
            $table->timestamp( 'vessel_etd' )->nullable();
            $table->timestamp( 'vessel_eta' )->nullable();
            $table->timestamp( 'door_delivery_eta' )->nullable();
            $table->text( 'notes' )->nullable();
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
        Schema::dropIfExists('project_production_schedules');
    }
}
