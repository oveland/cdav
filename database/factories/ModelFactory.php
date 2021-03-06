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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'demo_to' => \Carbon\Carbon::today()->addDays(15),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/*
 * @var \Illuminate\Database\Eloquent\Factory $factory
 * Create Inventory registers
 */
$factory->define(App\Inventory::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->dateTimeBetween('-2 years','now'),
        'admission_reason_id' => array_random(\App\AdmissionReason::all()->pluck('id')->toArray()),
    ];
});

/*
 * @var \Illuminate\Database\Eloquent\Factory $factory
 * Create CarsInventory registers
 */
$factory->define(App\CarsInventory::class, function (Faker\Generator $faker) {
    return [
        'plate' => strtoupper(str_random(3) . '-' . rand(100, 999)),
        'engine_number' => str_random(8),
        'chassis_number' => rand(10211230, 99912331),
        'model' => rand(1990, 2030),
        'color' => $faker->colorName,
        'registration_city' => $faker->city,
        'pending_judicial' => $faker->boolean(),
        'cars_type_id' => array_random(\App\CarsType::all()->pluck('id')->toArray()),
        'cars_state_id' => array_random(\App\CarsState::all()->pluck('id')->toArray()),
        'cars_proprietary_id' => function () {
            return factory(App\CarsProprietary::class)->create()->id;
        }
    ];
});

/*
 * @var \Illuminate\Database\Eloquent\Factory $factory
 * Create CarsProprietary registers
 */
$factory->define(App\CarsProprietary::class, function (Faker\Generator $faker) {
    $identity_types = ['CC', 'NIT'];
    return [
        'identity_type' => $identity_types[array_rand($identity_types, 1)],
        'identity' => rand(9876543, 98765432),
        'name' => $faker->firstName() . ' ' . $faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});

/*
 * @var \Illuminate\Database\Eloquent\Factory $factory
 * Create InventoryProcess registers
 */
$factory->define(App\InventoryProcess::class, function (Faker\Generator $faker) {
    return [
        'date' => \Carbon\Carbon::now(),
    ];
});

/*
 * @var \Illuminate\Database\Eloquent\Factory $factory
 * Create AbandonmentDeclaration registers
 */
$factory->define(App\AbandonmentDeclaration::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->dateTime,
        'resolution_number' => rand(32098, 586979)
    ];
});

/*
 * @var \Illuminate\Database\Eloquent\Factory $factory
 * Create AbandonmentDeclaration registers
 */
$factory->define(App\CarsLimitation::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Medida Provisional ' . str_random(5),
        'issuing' => 'Juzgado Emisor ' . str_random(5),
        'motive' => 'Motivo de la limitaci??n',
        'description' => 'Descripci??n opcional de la limitaci??n'
    ];
});
