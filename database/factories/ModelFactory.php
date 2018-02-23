<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $name = $faker->name;
	return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
		'slug' => str_slug($name),
		'gender' => 0,
		'avatar' => 'public/default/female.png',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'location' => $faker->city,
		'about' => $faker->paragraph(2),
    ];
});

$factory->define(App\Thread::class, function (Faker $faker) {
    $title = $faker->word;
	return [
        'title' => $title,
		'slug' => str_slug($title),
        'content' => $faker->paragraph(2),
        'user_id' =>function(){
			return factory(App\User::class)->$id;
		},
		'channel_id' =>function(){
			return factory(App\Channel::class)->$id;
		}		
    ];
});
