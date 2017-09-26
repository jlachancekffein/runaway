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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'preferences' => json_encode([
            'hairColor' => 'blond-clair',
            'eyeColor' => 'vert',
            'skinColor' => 'f6e9da',
            'bodyShape' => 'athletic',
            'height' => '1',
            'weight' => '2',
            'weightUnit' => '3',
            'braBandSize' => '4',
            'braCupSize' => '5',
            'shoeSize' => '6',
            'pantsSize' => '7',
            'favoritePants' => '8',
            'shirtSize' => '9',
            'dressSize' => '10',
            'piercedEars' => '11',
            'name' => 'Jane Doe',
            'address' => '2020 test street',
            'city' => 'Test',
            'postal_code' => 'G1K3C8',
            'province' => 'quebec',
            'phone' => '4185221799',
            'contact_method' => 'Morse',
            'terms' => 'Yes',
            'lastQuestionAnswered' => '10',
        ]),
    ];
});

$factory->define(App\Models\KitRequest::class, function (Faker\Generator $faker) {
    return [
        'name' => 'New suit',
        'budget' => 300,
        'comment' => 'Tiger of sweden only!',
    ];
});

$factory->define(\App\Models\Kit::class, function (\Faker\Generator $faker) {
    return [
        'kit_request_id' => function () {
            return factory(\App\Models\KitRequest::class)->create()->id;
        },
        'status' => 'draft',
    ];
});

$factory->define(\App\Models\Product::class, function (\Faker\Generator $faker) {
    return [
        'kit_id' => function () {
            return factory(\App\Models\Kit::class)->create()->id;
        },
        'name' => 'Jeans',
        'regular_price' => $faker->numberBetween(0, 10000),
        'marker_x' => $faker->numberBetween(0, 1000),
        'marker_y' => $faker->numberBetween(0, 1000),
        'brand' => 'Cheikha',
    ];
});

$factory->define(\App\Models\Address::class, function (\Faker\Generator $faker) {
    return [
        'address_id' => 0,
        'customer_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
        'address' => '2020 test street',
        'city' => 'Testville',
        'province' => 'ontario',
        'postal_code' => 'T3S7I2',
    ];
});

$factory->define(\App\Models\Transaction::class, function (\Faker\Generator $faker) {
    return [
        'kit_id' => function () {
            return factory(\App\Models\Kit::class)->create()->id;
        },
        'customer_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
        'subtotal' => 1234.56,
        'express_shipping' => false,
        'tax0' => 185.18,
        'total' => 1419.74,
        'shipping_address' => 'contact',
        'billing_address' => 'contact',
        'stripe_transaction_id' => 'hardcodedStripeId',
        'status' => 'paid',
    ];
});