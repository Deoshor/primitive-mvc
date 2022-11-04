<?php

namespace App\Models;

use Framework\Src\CommentModel;

class Comment extends CommentModel
{
    public $table = 'forum.comments';
    public $data;
}