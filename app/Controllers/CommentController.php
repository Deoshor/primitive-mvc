<?php 

namespace App\Controllers;

use App\Models\Comment;
use App\Models\CommentFile;
use App\Services\ImageService;
use Framework\Src\Auth\Auth;


class CommentController
{
    public function create(Comment $comment): void
    {
        $imageService = new ImageService;
        $data_comment = $_POST;
        $user = Auth::user();
        $data_comment['comment2user'] = $user['id'];
        $data_comment['last_update_date'] = date("Y-m-d H:i:s");

        if (!$_FILES['comment_files']['tmp_name'][0] == ""){
            if ($imageService->validateSize('comment_files', $_FILES) && $imageService->validateType('comment_files', $_FILES)) {
                if($comment->createComment($data_comment)) {
                    $comment_id = $comment->getLastComment();
                    $dir = substr(__DIR__, 0, -15) . 'storage\comments\\';
                    foreach ($imageService->uniqImageName($_FILES['comment_files']['name']) as $file) {
                        $data_comment['comment_files'][] = $file;
                    }

                    $data_file = array_combine($_FILES['comment_files']['tmp_name'], $data_comment['comment_files']);
                    foreach ($data_file as $key => $value) {
                        move_uploaded_file($key, $dir . $value);
                    }

                    foreach ($data_comment['comment_files'] as $file) {
                        $comment_file = new CommentFile();
                        $comment_file->createCommentFile($comment_id['id'], $file);
                    }
                }
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $comment->createComment($data_comment);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function update(Comment $comment): void
    {
        $imageService = new ImageService;
        $data_comment = $_POST;
        $user = Auth::user();
        $data_comment['comment2user'] = $user['id'];

        if (!$_FILES['comment_files']['tmp_name'][0] == "") {
            if ($imageService->validateSize('comment_files', $_FILES) && $imageService->validateType('comment_files', $_FILES)) {
                $comment->updateComment($data_comment['id'], $data_comment);

                $comment_file = new CommentFile();
                $data_comment['comment_files'] = $imageService->uniqImageName($_FILES['comment_files']['name']);
                foreach ($data_comment['comment_files'] as $item) {
                    $comment_file->createCommentFile($_POST['id'], $item);
                }


                $dir = substr(__DIR__, 0, -15) . 'storage\comments\\';
                $data_file = array_combine($_FILES['comment_files']['tmp_name'], $data_comment['comment_files']);
                foreach ($data_file as $key => $value) {
                    move_uploaded_file($key, $dir . $value);
                }
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $comment->updateComment($data_comment['id'], $data_comment);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }   

    public function delete(Comment $comment, CommentFile $commentFile): void
    {
        $commentFile->deleteCommentFiles($_POST['comment_id']);

        $comment->deleteComment($_POST['comment_id']);
        header('Location: /article?id=' . $_POST['article_id']);
    }
}