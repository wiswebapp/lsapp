<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $user = factory(App\User::class)->create();
    return [
        'user_id' => $user->id,
        'title' => $faker->sentence(10),
        'content' => $faker->paragraph(50),
        'remember_token' => Str::random(10),
    ];
});
