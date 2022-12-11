<?php

namespace App\Models;

use framework\src\models\ArticleModel;

class Article extends ArticleModel
{
    public $table = 'forum.articles';
    public $data;
}