<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteSubjectIdsLpg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learn_program_groups', function (Blueprint $table){
            $table->dropForeign('learn_program_groups_subject_id_foreign');
            $table->dropColumn('subject_id');
            $table->dropForeign('learn_program_groups_subject_id2_foreign');
            $table->dropColumn('subject_id2');
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
