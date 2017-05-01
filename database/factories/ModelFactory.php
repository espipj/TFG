<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Ganado::class, function (Faker\Generator $faker) {

    return [
        'crotal' => $faker->numberBetween(2000, 9999),
        'fecha_nacimiento' => $faker->dateTime,
        'capa' => array_rand(['C', 'N'],1)
    ];


});

$factory->define(App\Ganaderia::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'sigla' => $faker->countryCode,
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber
    ];


});

$factory->define(App\Ganadero::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'apellido1' => $faker->word,
        'apellido2' => $faker->word,
        'dni' => $faker->numberBetween(0, 9999999),
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber
    ];


});

$factory->define(App\Asociacion::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'direccion' => $faker->address,
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber
    ];


});

$factory->define(App\Explotacion::class, function (Faker\Generator $faker) {

    return [
        'municipio' => $faker->city,
        'codigo_explotacion' => $faker->text(15),
    ];


});
