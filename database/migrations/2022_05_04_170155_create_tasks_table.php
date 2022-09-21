<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('user_id');
            $table->String('name');
            $table->String('description');
            $table->String('sprint');
            $table->String('dependencies');
            $table->String('hours');
            $table->integer('project_id');
            $table->integer('cat_size_id');
            $table->integer('cat_phase_id');
            $table->bigInteger('cat_statuses_id')->default(1)->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('project_id')->references('id')->on('projects')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('cat_size_id')->references('id')->on('cat_sizes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('cat_phase_id')->references('id')->on('cat_phases')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('cat_statuses_id')->references('id')->on('cat_statuses')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
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
        Schema::dropIfExists('tasks');
    }
}
