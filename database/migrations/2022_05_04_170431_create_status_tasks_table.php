<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('task_id');
            $table->bigInteger('cat_status_id');
            $table->bigInteger('cat_status_causes_id')->nullable();
            $table->timestamps();

            $table->foreign('cat_status_id')->references('id')->on('cat_statuses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('cat_status_causes_id')->references('id')->on('cat_status_causes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_tasks');
    }
}
