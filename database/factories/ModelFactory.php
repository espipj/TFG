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

$factory->define(/**
 * We use faker to create random Users
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 * @link https://laravel.com/docs/5.1/testing#model-factories
 */
    App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(/**
 * We use faker to create random Ganado
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Ganado::class, function (Faker\Generator $faker) {


    return [
        'crotal' => $faker->countryCode . $faker->numberBetween(100000000000, 999999999999),
        'fecha_nacimiento' => $faker->date(),
    ];


});

$factory->define(/**
 * We use faker to create random Ganaderia
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Ganaderia::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'sigla' => $faker->countryCode,
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber
    ];


});

$factory->define(/**
 * We use faker to create random Ganadero
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Ganadero::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'apellido1' => $faker->word,
        'apellido2' => $faker->word,
        'dni' => $faker->numberBetween(0, 9999999),
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber
    ];


});

$factory->define(/**
 * We use faker to create random Asociacion
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Asociacion::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'direccion' => $faker->address,
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber
    ];


});

$factory->define(/**
 * We use faker to create random Explotacion
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Explotacion::class, function (Faker\Generator $faker) {

    return [
        'municipio' => $faker->city,
        'codigo_explotacion' => $faker->text(15),
    ];


});

$factory->define(/**
 * We use faker to create random Laboratorio
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Laboratorio::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'direccion' => $faker->streetName,
        'email' => $faker->email,
        'telefono' => $faker->phoneNumber,
    ];


});
$factory->define(/**
 * We use faker to create random Muestra
 * @param \Faker\Generator $faker
 * @return array
 * @link https://github.com/fzaninotto/Faker#basic-usage Info about how to work with faker
 */
    App\Muestra::class, function (Faker\Generator $faker) {

    return [
        'tubo'  =>  $faker->numberBetween(000000,128379183434),
        'fecha_extraccion'  =>  $faker->date(),

    ];


});
