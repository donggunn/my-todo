<?php

namespace App\Modules\Articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'thumb'
    ];
}
