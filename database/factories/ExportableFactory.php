<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exportable;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Exportable::class, function (Faker $faker) {
    $user = User::first();
    if (!$user) {
        $user = factory(User::class)->create();
    }
    return [
        'exportable_type' => User::class,
        'exportable_id' => $user->id,
        'exported' => false,
    ];
});
