<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('university_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('overall_rating'); //Общая оценка
            $table->string('statistic_analysis'); //Статистический анализ
            $table->string('loyalty_index'); //Индекс лоялности
            $table->string('online_resource'); //Интернет-ресурс
            $table->timestamps();
        });
        Schema::table('rating', function (Blueprint $table) {
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
        });

        DB::statement("INSERT INTO `partners` (`id`, `link`, `image`, `created_at`, `updated_at`) VALUES
(1, '#', '1542520435.png', '2018-11-13 21:16:15', '2018-11-17 17:53:55'),
(2, '#', '1542520447.png', '2018-11-13 21:18:17', '2018-11-17 17:54:07'),
(3, '#', '1542520455.png', '2018-11-13 21:18:30', '2018-11-17 17:54:15'),
(4, '#', '1542520464.png', '2018-11-13 21:18:41', '2018-11-17 17:54:24'),
(5, 'http://he.local/admin/partner/add/5', '1543206835.gif', '2018-11-17 16:27:01', '2018-12-03 05:39:01');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating');
    }
}
