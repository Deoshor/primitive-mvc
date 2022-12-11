<?php

namespace App\Models;

use framework\src\models\CommentModel;

class Comment extends CommentModel
{
    public $table = 'forum.comments';
    public $data;
}