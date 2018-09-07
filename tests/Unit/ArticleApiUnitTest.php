<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Modules\Articles\Article;
use App\Modules\Articles\Repositories\ArticleRepository;
use App\Modules\Articles\Exceptions\ArticleNotFoundException;
use App\Modules\Articles\Exceptions\ArticleInvalidArgumentException;

class ArticleApiUnitTest extends TestCase
{
    /** @test */
    public function it_can_save_the_thumb_file_in_storage()
    {
        $file = UploadedFile::fake()->image('demo.png', 500, 500);

        $article = factory(Article::class)->create();
        $articleRepo = new ArticleRepository($article);
        $filename = $articleRepo->saveCoverImage($file);

        $exist = Storage::disk('public')->exists($filename);

        $this->assertTrue($exist);
    }
    /** @test */
    public function it_errors_updating_the_article_with_required_fields_are_not_passed()
    {
        $this->expectException(ArticleInvalidArgumentException::class);

        $articleRepo = new ArticleRepository($this->article);
        $articleRepo->updateArticle(['title'=>null], $this->article->id);
    }
    /** @test */
    public function it_errors_creating_the_article_when_required_fields_are_not_passed()
    {
        $this->expectException(ArticleInvalidArgumentException::class);

        $articleRepo = new ArticleRepository(new Article);
        $articleRepo->createArticle([]);
    }
    /** @test */
    public function it_can_delete_an_article()
    {
        $articleRepo = new ArticleRepository(new Article);
        $delete = $articleRepo->deleteArticle($this->article);

        $this->assertDatabaseMissing('articles', collect($this->article)->all());
    }
    /** @test */
    public function it_can_list_all_article()
    {
        $article = factory(Article::class)->create();
        $attributes = $article->getFillable();

        $articleRepo = new ArticleRepository(new Article);
        $articles = $articleRepo->listArticles();

        $articles->each(function($article, $key) use ($attributes){
            foreach ($article->getFillable() as $key => $value) {
                $this->assertArrayHasKey($key, $attributes);
            }
        });
    }
    /** @test */
    public function it_errors_finding_an_article()
    {
        $this->expectException(ArticleNotFoundException::class);
        $this->expectExceptionMessage('Article not found');

        $articleRepo = new ArticleRepository(new Article);
        $resutl = $articleRepo->findArticleById(6969);
    }
    /** @test */
    public function it_can_find_an_article()
    {
        $articleRepo = new ArticleRepository(new Article);
        $result = $articleRepo->findArticleById($this->article->id);

        $this->assertEquals($this->article->id, $result->id);
        $this->assertEquals($this->article->title, $result->title);
        $this->assertEquals($this->article->content, $result->content);
    }
    /** @test */
    public function it_can_update_an_article()
    {
        //$article = factory(Article::class)->create();
        $file = UploadedFile::fake()->image('demo.png', 500, 600);

        $params = [
            'title' => 'test',
            'content' => 'hihi haha'
        ];
        
        $articleRepo =  new ArticleRepository($this->article);
        $update = $articleRepo->updateArticle($params, $this->article->id);

        $this->assertTrue($update);

    }
    /** @test */
    public function it_can_create_an_article()
    {   
        $file = UploadedFile::fake()->image('article.png', 600, 600); 
        $data = [
            'title'=> $this->faker->sentence,
            'content'=> $this->faker->paragraph,
            'thumb' => $file 
        ];
        $articleRepo = new ArticleRepository(new Article);
        $create = $articleRepo->create($data);
        
        $this->assertInstanceOf(Article::class, $create);
        $this->assertEquals($create->title, $data['title']);
        $this->assertEquals($create->content, $data['content']);
        $this->assertEquals($create->thumb, $data['thumb']);
    }
}