<?php 

namespace App\Modules\Tasks\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskNotFoundException extends ModelNotFoundException
{
    /**
     * TaskNotFoundException construct
     */
    public function __construct()
    {
        parent::_construct('Task not found');
    }
}