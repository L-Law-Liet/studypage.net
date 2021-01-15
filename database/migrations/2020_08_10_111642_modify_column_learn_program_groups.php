<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnLearnProgramGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learn_program_groups', function (Blueprint $table){
            $table->dropForeign('learn_program_groups_degree_id_foreign');
            $table->dropColumn('degree_id');
            $table->dropForeign('learn_program_groups_direction_id_foreign');
            $table->dropColumn('direction_id');
            $table->unsignedInteger('subdirection_id')->nullable()->change();
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
