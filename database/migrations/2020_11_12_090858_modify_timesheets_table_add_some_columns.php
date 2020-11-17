<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTimesheetsTableAddSomeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'timesheets', function ( Blueprint $table ) {
            $table->date( 'date' )->nullable();
            $table->time( 'time_in_1' )->nullable();
            $table->time( 'time_out_1' )->nullable();
            $table->time( 'time_in_2' )->nullable();
            $table->time( 'time_out_2' )->nullable();
            $table->float( 'regular_hrs' )->nullable();
            $table->float( 'holiday_hrs' )->nullable();
            $table->float( 'overtime_hrs' )->nullable();
            $table->float( 'sick_hrs' )->nullable();
            $table->float( 'vacation_hrs' )->nullable();
            $table->dropColumn( 'data' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'timesheets', function ( Blueprint $table ) {
        });
    }
}
