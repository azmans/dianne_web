<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;
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
        'user_type' => 'soon-to-wed',
        'bride_first_name' => $faker->firstNameFemale,
        'bride_last_name' => $faker->lastName,
        'groom_first_name' => $faker->firstNameMale,
        'groom_last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'wedding_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'profile_picture' => null,
        'last_login_at' => null,
        'blacklisted_at' => null,
        'remember_token' => Str::random(10),
    ];
});
