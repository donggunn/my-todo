<?php

namespace App\Modules\Tasks;

use App\Modules\Users\User;
use App\Modules\Categories\Category;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $fillable = ['name', 'user_id', 'category_id', 'order'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\belongsTo;
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
