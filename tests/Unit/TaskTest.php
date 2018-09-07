<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Modules\Tasks\Task;
use App\Modules\Users\User;
use App\Modules\Categories\Category;
use App\Modules\Tasks\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    /** @test */
    public function it_can_update_the_task()
    {
        $task = factory(Task::class)->create();
        $data = [
            'name'=>$this->faker->sentence,
        ];
        $taskRepo = new TaskRepository(new Task);
        $update = $taskRepo->updateTask($data, $task->id);
        
        $this->assertTrue($update);

    }
    /** @test */
    public function it_can_create_the_task()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $data = [
            'name' => $this->faker->sentence,
            'user_id' =>$user->id,
            'category_id'=> $category->id,
            'order'=>$this->faker->biasedNumberBetween(10, 100)
        ];
        $taskRepo = new TaskRepository(new Task);
        $create = $taskRepo->createTask($data);

        $this->assertInstanceof(Task::class, $create);
        $this->assertEquals($create->name, $data['name']);
    }
}
