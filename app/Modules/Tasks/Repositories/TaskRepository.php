<?php
namespace App\Modules\Tasks\Repositories;

use App\Modules\Tasks\Task;
use App\Modules\Base\BaseRepository;
use Illuminate\Database\QueryException;
use App\Modules\Tasks\Exceptions\TaskInvalidArgumentException;
use App\Modules\Tasks\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    protected $model;

    /**
     * TaskRepository construct
     * @param Task $task 
     */
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    /**
     * List all task
     * @param array $column
     * @param string $order
     * @param string $sort
     * @return Collection
     */
    public function listTasks($column = array('*'), $order ='id', $sort='asc')
    {
        return $this->all($column, $order, $sort);
    }

    /**
     * Create the task
     * @param array $attributes
     * @return mixed
     * @throws TaskInvalidArgumentException
     */
    public function createTask(array $attributes)
    {
        try{
            return $this->create($attributes);
        }catch(QueryException $e){
            throw new TaskInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update the task
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function updateTask(array $attributes, $id)
    {
        try{
            return $this->update($attributes, $id);
        }catch(QueryException $e){
            throw new TaskInvalidArgumentException($e->getMessage());
        }
    }

    public function findTaskById($id)
    {
        try{
            return $this->findOneOrFail($id);
        }catch(ModelNotFoundException $e){
            throw new TaskNotFoundException($e->getMessage());
        }
    }
    public function deleteTask(Task $task)
    {
        return $task->delete();
    }

    public function findTaskByOrder($start, $end)
    {
        try{
            return $this->model->whereBetween('order', [$start, $end])->get();
        }catch(ModelNotFoundException $e){
            throw new TaskNotFoundException($e->getMessage());
        }
    }
}