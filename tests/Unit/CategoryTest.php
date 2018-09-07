<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Modules\Categories\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modules\Categories\Repositories\CategoryRepository;

class CategoryTest extends TestCase
{

    /** @test */
    public function it_can_create_the_category()   
    {
        $data = [
            'name'=> $this->faker->sentence
        ];

        $categoryRepo = new CategoryRepository(new Category);
        $create = $categoryRepo->createCategory($data);

        $this->assertInstanceof(Category::class, $create);
        $this->assertEquals($create->name, $data['name']);
    }
}
