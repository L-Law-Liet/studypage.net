<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialties', function (Blueprint $table){
            $table->dropColumn('sphere');
            $table->integer('sphere_id')->after('education_time')->nullable()->unsigned();
        });
        Schema::table('cost_education', function (Blueprint $table){
            $table->integer('year')->after('rating')->nullable();
            $table->string('total')->after('year')->nullable();
            $table->integer('number_grants_ru')->after('total')->nullable(); //количество грантов русс. отделение
            $table->integer('number_grants_kz')->after('number_grants_ru')->nullable();
            $table->string('passing_score_ru')->after('number_grants_kz')->nullable(); //проходной балл на русс. отделение
            $table->string('passing_score_kz')->after('passing_score_ru')->nullable();
        });

        Schema::table('requirements', function (Blueprint $table){
            $table->dropColumn('name_ru');
            $table->dropColumn('name_kz');
            $table->integer('degree_id')->after('id')->unsigned();
        });

        Schema::table('requirements', function (Blueprint $table) {
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::create('sphere', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru');
            $table->timestamps();
        });

        Schema::table('specialties', function (Blueprint $table) {
            $table->foreign('sphere_id')->references('id')->on('sphere')->onDelete('restrict')->onUpdate('restrict');
        });

        DB::table('sphere')->insert([
            'name_ru' => 'Научно-педагогическое',
        ]);
        DB::table('sphere')->insert([
            'name_ru' => 'Профильное',
        ]);
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
