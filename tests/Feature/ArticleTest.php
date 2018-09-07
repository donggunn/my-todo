<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Users\User;
use Laravel\Passport\Passport;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{
    /**
     * @test
     */ 
    public function it_can_create_the_article()
    {
        $file = UploadedFile::fake()->image('article.png', 600, 600);
        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'thumb' => $file
        ];

        $this->actingAs($this->user,'api')
            ->post('api/v1/articles', $data)
            //->dump()
            ->assertStatus(201)
            ->assertJsonStructure(array_keys($data), $data);
    }

    /** @test */
    public function it_can_update_the_article()
    {
        $data = [
            'title' => 'Test',
            'content' => 'sdfsdf sdf as fsd fs dfas dfsdf'
        ];

        $this->actingAs($this->user, 'api')
            ->put('api/v1/articles/'.$this->article->id, $data)
            ->assertStatus(200);
    }
    
}
