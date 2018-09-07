<?php
namespace App\Modules\Categories\Repositories\Interfaces;

use App\Modules\Categories\Category;
use App\Modules\Base\Interfaces\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function listCategory($order='id', $sort='desc', $except = array());

    public function createCategory(array $attributes);

    public function updateCategory(array $attributes, $id);

    public function findCategoryById($id);

    public function deleteCategory(Category $category);

    public function findTasks();

    public function findTaksBetweenOrder($start, $end);
}