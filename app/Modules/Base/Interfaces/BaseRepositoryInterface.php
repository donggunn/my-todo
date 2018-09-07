<?php
namespace App\Modules\Base\Interfaces;

interface BaseRepositoryInterface
{
    public function create(array $attributes);

    public function update(array $attributes, $id);

    public function all($column = array('*'), $orderBy, $sortBy);

    public function find($id);

    public function findOneOrFail($id);

    public function findBy(array $data);

    public function findOneBy(array $data);

    public function findOneByOrFail(array $data);

    public function paginateArrayResults(array $data, $perPage);

    public function delete($id);
}