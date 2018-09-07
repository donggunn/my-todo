<?php
namespace App\Modules\Tasks\Repositories\Interfaces;

use App\Modules\Tasks\Task;
use App\Modules\Base\Interfaces\BaseRepositoryInterface;

interface TaskRepositoryInterface extends BaseRepositoryInterface
{
    public function listTasks($columns = array('*'), $order = 'id', $sort ='desc');

    public function createTask(array $attributes);

    public function updateTask(array $attributes, $id);

    public function findTaskById($id);

    public function deleteTask(Task $task);

    public function findTaskByOrder($start, $end);
}