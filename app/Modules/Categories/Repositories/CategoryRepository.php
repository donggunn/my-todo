<?php

namespace App\Modules\Categories\Repositories;

use App\Modules\Base\BaseRepository;
use App\Modules\Categories\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Modules\Categories\Exceptions\CategoryNotFoundException;
use App\Modules\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $model;
    /**
     * CategoryRepository construct
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->model = $category;
    }

    /**
     * List all the category
     * @param array $columns
     * @param string $order
     * @param string $sort
     */
    public function listCategory($order='id', $sort='desc', $except = array())
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }
    /**
     * Create the category
     * @param array $attributes
     * @return Category
     * @throws CategoryInvalidArgumentException
     */
    public function createCategory(array $attributes)
    {
        try {
            return $this->create($attributes);
        } catch (QueryException $e) {
            throw new CategoryInvalidArgumentException($e->getMessage());
        }
    }
    public function updateCategory(array $attributes, $id)
    {
    }
    public function findCategoryById($id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }
    public function deleteCategory(Category $category)
    {
        # code...
    }
    public function findTasks()
    {
        return $this->model->tasks()->orderBy('order')->get();
    }

    public function findTaksBetweenOrder($start, $end)
    {
        try{
            return $this->model->tasks()->whereBetween('order', [$start, $end])->get();
        }catch(ModelNotFoundException $e){
            throw new TaskNotFoundException($e->getMessage());
        }
    }
}
