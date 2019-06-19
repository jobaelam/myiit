<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'profile_image' => 'http://via.placeholder.com/150x150',
        'dept_id' => rand(1,3),
        'type' => '2',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(App\Chat::class, function (Faker $faker) {

    do{
        $from = rand(2,10);
        $to = rand(2,10);
    } while ($from === $to);

    return [
        'user1' => $from,
        'user2' => $to,
    ];
});

$factory->define(App\Chat_Message::class, function (Faker $faker) {

    return [
        'chat_id' => random_int(1,8),
        'sender_id' => random_int(2,10),
        'message' => $faker->sentence,
    ];
});