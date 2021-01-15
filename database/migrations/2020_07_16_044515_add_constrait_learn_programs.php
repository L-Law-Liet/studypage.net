<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraitLearnPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `learn_programs` DROP `university_id`");
        DB::statement("ALTER TABLE `learn_programs` DROP `degree_id`");
        Schema::table('learn_programs', function (Blueprint $table) {
            $table->unsignedInteger('university_id');
            $table->unsignedInteger('degree_id');
        });
        Schema::table('learn_programs', function ($table){
            $table->foreign('university_id')->references('id')->on('universities');
            $table->foreign('degree_id')->references('id')->on('degrees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
