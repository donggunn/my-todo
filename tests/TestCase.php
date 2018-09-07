<?php

namespace Tests;
use App\Modules\Tasks\Task;
use App\Modules\Users\User;
use Faker\Factory as Faker;
use App\Modules\Articles\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 * @runTestsInSeparateProcesses
 * preserveGlobalState disable
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, DatabaseTransactions;   
    
    protected $faker;
    protected $article;
    protected $task;
    protected $user;

    /**
     * Set up the test
     */
    public function setUp(){
        parent::setUp();
        $this->artisan('passport:install');
        
        $this->faker = Faker::create();

        $this->article = factory(Article::class)->create();
        $this->task = factory(Task::class)->create();
        $this->user = factory(User::class)->create();

        $token = $this->user->createToken('TestToken')->accessToken;
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer '.$token;
    }

    /**
     * Reset the migrations
     */
    public function tearDown(){
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
