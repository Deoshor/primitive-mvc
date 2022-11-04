<?php

namespace App\Models;

use Framework\Src\ArticleModel;

class Article extends ArticleModel
{
    public $table = 'forum.articles';
    public $data;
}