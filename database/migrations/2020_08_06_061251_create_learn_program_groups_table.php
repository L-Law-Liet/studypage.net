<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearnProgramGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learn_program_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru');
            $table->unsignedInteger('direction_id');
            $table->foreign('direction_id')->references('id')->on('directions');
            $table->unsignedInteger('subdirection_id');
            $table->foreign('subdirection_id')->references('id')->on('subdirections');
            $table->unsignedInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedInteger('subject_id2')->nullable();
            $table->foreign('subject_id2')->references('id')->on('subjects');
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
        Schema::dropIfExists('learn_program_groups');
    }
}
