<?php

namespace App\Providers;

use App\Modules\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Modules\Articles\Repositories\ArticleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to implementation repository class 
     */
    public function register()
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );
    }
}