<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kategori;
use Faker\Generator as Faker;

$factory->define(Kategori::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'kode' => $faker->unique()->numberBetween($min = 1, $max = 10)
    ];
});
