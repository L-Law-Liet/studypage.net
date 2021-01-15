<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFaqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) { //Форма обратной связи
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('question');
            $table->text('answer');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });

        Schema::create('requirements', function (Blueprint $table) { //Требование к поступлению
            $table->increments('id');
            $table->string('name_ru');
            $table->string('name_kz')->nullable();
            $table->text('content_ru');
            $table->text('content_kz')->nullable();
            $table->timestamps();
        });

        DB::table('faqs')->insert([
            'question' => 'Что я хочу изучать?',
            'answer' => 'Некоторые люди всегда знают «что они хотят учить» и «какой именно предмет они хотели бы изучать». Другие же вообще не имеют представления об этом. В таких ситуациях, необходимо задать себе нижеуказанные базовые вопросы, которые помогут Вам в поиске ответов на данные вопросы:'
        ]);

        DB::table('faqs')->insert([
            'question' => 'От чего я действительно получаю удовольствие?',
            'answer' => 'Этот вопрос Вы должны задать себе в первую очередь, перед тем как начать думать о будущей работе и каких-либо карьерных перспективах. В конце концов, ответ на вопрос «что действительно приносит Вам удовольствие» может повлиять на всю оставшуюся Вашу жизнь. Поэтому, Вы должны убедиться в том, что Вы изучаете – то, что действительно Вам нравиться.'
        ]);

        DB::table('faqs')->insert([
            'question' => 'Что меня интересует?',
            'answer' => 'Вас интересует много вещей? В этом случае, составьте перечень всех вещей, которые Вас интересуют. Затем попробуйте объединить несколько разных Ваших интересов. Например, если Вы заинтересованы в иностранных культурах, географии и политике – Вы можете с учетом данных интересов выбрать область, которая будет интересным для Вас.'
        ]);

        DB::table('faqs')->insert([
            'question' => 'Какие у меня имеются таланты?',
            'answer' => 'Иногда Ваши интересы могут не соответствовать Вашим особым талантам, и, наоборот. Например, если Вы заинтересованы в медицине, но у Вас мало склонности к предметам естествознания, Вам нужно тщательно подумать, действительно ли Вы хотите изучать медицину.'
        ]);

        DB::table('faqs')->insert([
            'question' => 'В какой области я хочу учиться?',
            'answer' => 'После того как Вы тщательно рассмотрите вышеуказанные вопросы, Вы должны попытаться найти общую область, в которой Вы хотели бы учиться. Еще лучше, если Вы выбрали несколько интересующих Вас областей для изучения, которые будут полезными Вам в будущем.'
        ]);

        DB::table('faqs')->insert([
            'question' => 'Дальнейшие действия?',
            'answer' => 'Теперь Вам нужно сделать следующий шаг, и решить какой именно конкретный предмет Вы хотите изучать. На данном этапе Вам наверняка понадобится помощь, и Вы захотите узнать сведения «о ВУЗах и имеющихся в нем специальностей», и для этого Вам нужно использовать разные интернет платформы, чтобы найти хоть какую-то интересующую Вас информацию. Или же Вы можете воспользоваться сайтом unipage.kz, чтобы получить всю необходимую информацию.'
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