<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->sentence(),
        'post_body' => $faker->paragraph(),
        'featured_image' => $faker->imageUrl($width = 840, $height = 580),
        'status' => 1,
        'category_id' => App\Models\Category::all()->random()->id,
        'user_id' => App\Models\User::all()->random()->id,
    ];
});
