<?php

namespace App\Modules\Articles\Repositories;

use App\Modules\Articles\Article;
use App\Modules\Base\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Modules\Articles\Exceptions\ArticleNotFoundException;
use App\Modules\Articles\Exceptions\ArticleInvalidArgumentException;
use App\Modules\Articles\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    protected $model;

    /**
     * ArticleRepository construct
     * @param Article $article
     */
    public function __construct(Article $article) 
    {
        $this->model = $article;
    }

    
    /**
     * List all the article
     * @param array $columns
     * @param string $order
     * @param string $sort
     * @return Collection
     */
    public function listArticles($columns = array('*'), $order= 'id', $sort = 'desc')
    {
        return $this->all($columns, $order, $sort);
    }
    
    /**
     * Create an article
     * @param array $attributes
     * @return mixed
     * @throws ArticleInvalidArgumentException
     */
    public function createArticle(array $attributes)
    {
        try{
            return $this->create($attributes);
        }catch(QueryException $e){
            throw new ArticleInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update an article
     * @param array $attributes
     * @param int $id
     * @return bool
     * @throws ArticleInvalidArgumentExeception
     */
    public function updateArticle(array $attributes, $id)
    {
        try{
            return $this->update($attributes, $id);
        }catch(QueryException $e){
            throw new ArticleInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Find one article by id
     * @param int $id
     * @return Article
     * @throws ArticleNotFoundException
     */
    public function findArticleById($id)
    {
        try{
            return $this->findOneOrFail($id);
        }catch(ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * Delete an article
     * @param int $id
     * @return bool
     */
    public function deleteArticle(Article $article)
    {
        return $article->delete();
    }
    /*
     * @param UploadedFile $file
     * @return string
     */
    public function saveCoverImage(UploadedFile $file)
    {
        return $file->store('articles', ['disk' => 'public']);
    }
} 