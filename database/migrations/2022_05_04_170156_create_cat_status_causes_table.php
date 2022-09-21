<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatStatusCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_status_causes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_status_id');
            $table->String('name');
            $table->String('description');
            $table->timestamps();

            $table->foreign('cat_status_id')->references('id')->on('cat_statuses')
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
        Schema::dropIfExists('cat_status_causes');
    }
}
