<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title'=>$faker->realText($maxNbChars = 50),
        'content'=>$faker->realText($maxNbChars=1000),
        
    ];
});
