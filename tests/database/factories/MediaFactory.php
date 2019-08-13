<?php

use Faker\Generator as Faker;
use Optix\Media\Models\Media;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Media::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'file_name' => 'file-name.png',
        'disk' => config('media.disk'),
        'mime_type' => 'image/png',
        'size' => $faker->randomNumber(4),
    ];
});
