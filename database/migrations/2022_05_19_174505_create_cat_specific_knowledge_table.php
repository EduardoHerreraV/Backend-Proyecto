<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatSpecificKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_specific_knowledge', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->bigInteger('cat_knowledge_area_types_id')->nullable();
            $table->timestamps();

            $table->foreign('cat_knowledge_area_types_id')->references('id')->on('cat_knowledge_area_types')
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
        Schema::dropIfExists('cat_specific_knowledge');
    }
}
