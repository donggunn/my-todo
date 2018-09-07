<?php

namespace App\Modules\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Tasks\Task;

class Category extends Model
{
    //
    protected $fillable = ['name', 'order'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id');
    }
}
