<?php
$factory->define(App\Modules\Categories\Category::class, function(Faker\Generator $faker){
    $name = $faker->unique()->randomElement([
        'New',
        'Assigned',
        'Doing',
        'Completed',
        'Review'
    ]);
    return [
        'name' => $name
    ];
});