<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name_ru'); //Название города
                $table->string('name_kz')->nullable();
                $table->text('description')->nullable();
                $table->string('image');
                $table->timestamps();
            });
        }

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->timestamps();
        });
        DB::table('types')->insert([
            'name_ru' => 'ВУЗ'
        ]);
        DB::table('types')->insert([
            'name_ru' => 'Институт'
        ]);
        DB::table('types')->insert([
            'name_ru' => 'Академия'
        ]);
        DB::table('types')->insert([
            'name_ru' => 'Консерватория'
        ]);

        Schema::create('universities', function (Blueprint $table) { //Универы
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->text('subdivision')->nullable();
            $table->integer('logo')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('address_ru')->nullable();
            $table->string('address_kz')->nullable();
            $table->string('phone')->nullable();
            $table->string('postcode')->nullable();
            $table->string('email')->nullable();
            $table->string('web_site')->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->text('information_ru')->nullable();
            $table->text('information_kz')->nullable();
            $table->integer('kz_rating')->nullable();
            $table->integer('i_rating')->nullable();
            $table->integer('user_id')->unsigned()->nullable(); //Owner (Пользователь который может редактировать данные своего универа)
            $table->timestamps();
        });

        Schema::table('universities', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::create('specialties', function (Blueprint $table) { //Специальности
            $table->increments('id');
            $table->string('cipher')->nullable(); //Шифр специальности
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->integer('direction_id')->unsigned(); //Направление обучения к которому относится данная специальность
            $table->integer('subject_id')->unsigned(); //Профильный предмет по которому можно поступить на эту специальность
            $table->integer('degree_id')->unsigned(); //Степень в магистратуре может и нет такой специальности
            $table->string('education_time', 20); //Срок обучения
            $table->text('sphere'); //Сфера направления
            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) { //Предметы (профильные)
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->timestamps();
        });

        Schema::create('degrees', function (Blueprint $table) { //Степень
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->timestamps();
        });

        Schema::create('directions', function (Blueprint $table) { //Направление
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->timestamps();
        });

        Schema::table('specialties', function (Blueprint $table) {
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('restrict')->onUpdate('restrict');
            //$table->foreign('form_education_id')->references('id')->on('form_education')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::create('cost_education', function (Blueprint $table) { //Стоимость обучения специальности в конкретном ВУЗе
            $table->increments('id');
            $table->integer('university_id')->unsigned()->nullable();
            $table->integer('specialty_id')->unsigned()->nullable();
            $table->integer('language_id')->unsigned()->nullable();
            $table->integer('language')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });

        Schema::create('languages', function (Blueprint $table){ //Языки обучения
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->timestamps();
        });

        Schema::table('cost_education', function (Blueprint $table) {
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('restrict')->onUpdate('restrict');
        });

        DB::table('degrees')->insert([
            'name_ru' => 'Бакалавриат',
            'name_kz' => 'Бакалавриат'
        ]);
        DB::table('degrees')->insert([
            'name_ru' => 'Магистратура',
            'name_kz' => 'Магистратура'
        ]);
        DB::table('degrees')->insert([
            'name_ru' => 'Докторантура',
            'name_kz' => 'Докторантура'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
}
