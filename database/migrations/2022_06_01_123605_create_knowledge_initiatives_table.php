<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeInitiativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_initiatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initiative_id')->nullable();
            $table->bigInteger('cat_knowledge_area_types_id')->nullable();
            $table->bigInteger('cat_specific_knowledge_id')->nullable();
            $table->timestamps();

            $table->foreign('initiative_id')->references('id')->on('initiatives')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('cat_knowledge_area_types_id')->references('id')->on('cat_knowledge_area_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('cat_specific_knowledge_id')->references('id')->on('cat_specific_knowledge')
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
        Schema::dropIfExists('knowledge_initiatives');
    }
}
