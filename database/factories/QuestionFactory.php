<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5,10)), "."), //rtrimで.を削除　5~10の数で作成
        'body' => $faker->paragraphs(rand(3,7), true), // 配列で返される為、第二引数にtrueを設定することで文字列で返す
        'views' => rand(0,10),
        // 'answers_count' => rand(0,10),
        'votes' => rand(-3,10)
    ];
});
