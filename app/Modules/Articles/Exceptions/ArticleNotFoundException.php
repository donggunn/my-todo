<?php

namespace App\Modules\Articles\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleNotFoundException extends NotFoundHttpException
{
    /**
     * ArticleNotFoundException construct
     */
    public function __construct()
    {
        parent::__construct('Article not found');
    }    

}