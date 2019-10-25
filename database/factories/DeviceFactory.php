<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
        'ip' => $faker->ipv4,
        'port' => $faker->numberBetween(1, 65534),
        'device_address' => $faker->numberBetween(0, 99)
    ];
});