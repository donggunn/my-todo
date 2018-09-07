<?php
$factory->define(App\Modules\Tasks\Task::class, function(Faker\Generator $faker){
    $category =  factory(App\Modules\Categories\Category::class)->create();
    $user = factory(App\Modules\Users\User::class)->create();

    return [
        'name'=>$faker->sentence,
        'user_id'=> $user->id,
        'category_id'=>$category->id,
        'order'=>$faker->biasedNumberBetween(10, 100)
    ];
});