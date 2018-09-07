<?php
use Illuminate\Http\UploadedFile;
$factory->define(App\Modules\Articles\Article::class, function(Faker\Generator $faker){
    $thumb = UploadedFile::fake()->image('article.png', 600, 600);
    return [
        'title'=> $faker->sentence,
        'content'=>$faker->paragraph,
        'thumb'=>$thumb->store('articles', ['disk'=>'public'])
    ];
});