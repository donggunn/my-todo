<?php

namespace App\Modules\Articles\Repositories\Interfaces;

use App\Modules\Base\Interfaces\BaseRepositoryInterface;
use App\Modules\Articles\Article;
use Illuminate\Http\UploadedFile;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
    public function listArticles($columns = array('*'), $orderBy = 'id', $sortBy = 'desc');
    
    public function createArticle(array $attributes);
    
    public function updateArticle(array $attributes, $id);

    public function findArticleById($id);

    public function deleteArticle(Article $article);

    public function saveCoverImage(UploadedFile $file);
}