<?php

namespace App\Modules\Categories\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryNotFoundException extends NotFoundHttpException
{
    /**
     * CategoryNotFoundException construct
     */
    public function __construct()
    {
        parent::__construct('Category not found');
    }    

}