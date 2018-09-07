<?php

namespace App\Modules\Users;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\Tasks\Task;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
    * The database name used by the model.
    *
    * @var string
    */
    protected $connection = 'mysql2'; 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks()
    {
        $this->hasMany(Task::class);
    }
}
