<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSpecialtyAndDropColumnCostEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialties', function (Blueprint $table){
            $table->unsignedInteger('education_form')->nullable()->after('degree_id')->default(null);
            $table->foreign('education_form')->references('id')->on('education_forms');
            $table->unsignedInteger('income')->nullable()->after('degree_id')->default(null);
            $table->foreign('income')->references('id')->on('incomes');
        });
        Schema::table('cost_education', function (Blueprint $table){
            $table->dropColumn('income');
            $table->dropColumn('education_form');
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
