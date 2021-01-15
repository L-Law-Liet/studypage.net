<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('universities', function (Blueprint $table){
            $table->dropColumn('kz_rating');
            $table->dropColumn('i_rating');
        });

        Schema::table('cost_education', function (Blueprint $table){
            $table->string('rating')->after('price')->nullable();
        });

        Schema::table('specialties', function (Blueprint $table){
            $table->integer('subject_id2')->unsigned()->after('subject_id');
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
