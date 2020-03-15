<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedInteger('views')->default(0); //質問が何回されたかを表示
            $table->unsignedInteger('answers')->default(0); //質問の回答数を表示
            $table->integer('votes')->default(0); //質問を投票している人数を表示
            $table->unsignedInteger('best_answer_id')->nullable(); //ベストアンサーのIDを表示
            $table->unsignedBigInteger('user_id'); //質問をした、ユーザーID
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //usersテーブルのuser_idを取得する　又、ユーザーが削除された際、質問も削除する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
