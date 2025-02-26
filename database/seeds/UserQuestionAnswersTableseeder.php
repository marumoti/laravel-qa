<?php

use Illuminate\Database\Seeder;

class UserQuestionAnswersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('answers')->delete();
        \DB::table('questions')->delete();
        \DB::table('users')->delete();
        
        factory(App\User::class, 3)->create()->each(function ($u) { //偽データを3つ作成
            $u->questions()
                ->saveMany(
                    factory(App\Question::class, rand(1, 5))->make()
                )
                ->each(function ($q) {
                    $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
                });
        });
    }
}
