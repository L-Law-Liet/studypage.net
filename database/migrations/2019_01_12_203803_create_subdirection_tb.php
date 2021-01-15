<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubdirectionTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table){
            $table->string('announce')->after('name_ru')->nullable();
        });

        if(!Schema::hasTable('subdirections')){
            Schema::create('subdirections', function (Blueprint $table) { //Направление
                $table->increments('id');
                $table->string('name_ru');
                $table->string('name_kz')->nullable();
                $table->integer('direction_id')->unsigned(); //Направление обучения к которому относится данная специальность
                $table->timestamps();
            });
        }
        Schema::table('subdirections', function (Blueprint $table) {
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('specialties', function (Blueprint $table) {
            $table->dropForeign(['direction_id']);
            $table->dropColumn('direction_id');
            $table->integer('subdirection_id')->after('name_kz')->unsigned()->nullable();
        });
        Schema::table('specialties', function (Blueprint $table) {
            $table->foreign('subdirection_id')->references('id')->on('subdirections')->onDelete('restrict')->onUpdate('restrict');
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
