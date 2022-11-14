<?php 

namespace App\Controllers;

use App\Models\Comment;
use App\Services\ImageService;


class CommentController
{
    public function create()
    {
        $imageService = new ImageService;
        $comments = new Comment();
        $data_comment = $_POST;
        $data_comment['comment2user'] = $_SESSION['id'];
        $data_comment['last_update_date'] = date("Y-m-d H:i:s");
        if ($imageService->validateSize('comment_files', $_FILES) && $imageService->validateType('comment_files', $_FILES)) {
            $data_comment['comment_files'] = $imageService->uniqImageName($_FILES['comment_files']['name']);
        }
        
        $comment = $comments->createComment($data_comment);
            $dir = substr(__DIR__, 0, -15) . 'storage\comments\\';
           
        if (isset($data_comment['comment_files'])) {
            $data_file = array_combine($_FILES['comment_files']['tmp_name'], $data_comment['comment_files']);
            foreach ($data_file as $key => $value) {
                move_uploaded_file($key, $dir . $value);
            }
        } 
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function update()
    {
        $imageService = new ImageService;
        $comments = new Comment();
        $data_comment = $_POST;
        $data_comment['comment2user'] = $_SESSION['id'];
        $images = [];
        if ($imageService->validateSize('comment_files', $_FILES) && $imageService->validateType('comment_files', $_FILES)) {
            $data_comment['comment_files'] = $imageService->uniqImageName($_FILES['comment_files']['name']);
            $images = $comments->getImages($_POST['id'], 'comment_files');
        }
        $comment = $comments->updateComment($data_comment['id'], $data_comment, $images);
            
            
        $dir = substr(__DIR__, 0, -15) . 'storage\comments\\';
        if (isset($data_comment['comment_files'])) {
            $data_file = array_combine($_FILES['comment_files']['tmp_name'], $data_comment['comment_files']);
            foreach ($data_file as $key => $value) {
                 move_uploaded_file($key, $dir . $value);
             }
        }
           
        header("Location: " . $_SERVER['HTTP_REFERER']);
        
    }   

    public function delete()
    {
        $comments = new Comment();
        $comment = $comments->deleteComment($_POST['id']);
        header('Location: /article?id=' . $_POST['article_id']);
    }
}