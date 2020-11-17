<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger( 'assigned_by_id' )->comment( 'The user that created the task.' );
            $table->unsignedInteger( 'assigned_to_id' )->comment( 'The user that has been assigned to the task.' );
            $table->unsignedInteger( 'project_id' )->nullable();
            $table->unsignedInteger( 'contact_id' )->nullable();
            $table->text( 'description' );
            $table->timestamp( 'assigned_at' )->nullable();
            $table->timestamp( 'due_at' )->nullable();
            $table->timestamp( 'completed_at' )->nullable();
            $table->timestamp( 'closed_at' )->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
