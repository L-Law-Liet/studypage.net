<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkDegreeLpg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learn_program_groups', function (Blueprint $table){
            $table->unsignedInteger('degree_id')->nullable()->after('name_ru');
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
        Schema::table('learn_program_groups', function (Blueprint $table) {
            $table->dropForeign('learn_program_groups_degree_id_foreign');
            $table->dropColumn('degree_id');
        });
    }
}
