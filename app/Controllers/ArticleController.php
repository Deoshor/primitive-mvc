<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\ArticleFile;
use App\Models\Comment;
use App\Models\CommentFile;
use App\Models\User;
use App\Services\ImageService;

class ArticleController
{
    public function index(): void
    {
        $articles = new Article();
        $article = $articles->getArticle($_SERVER['QUERY_STRING']);

        $comments = new Comment();
        $comment = $comments->getComments($_SERVER['QUERY_STRING']);

        $article_file = new ArticleFile();
        $article_files = $article_file->getArticleFilesById($article['id']);

        $comments_data['comment_data'] = $comment['last_update_date'];
        foreach ($comment as $item) {
            $user = new User();
            $user = $user->getUser($item['comment2user']);
            $item['author']  = $user['name'] . ' ' . $user['lastname'];
            $comments_data['comment_data'] = $item;

            $comment_file = new CommentFile();
            $comment_files = $comment_file->getCommentFilesById($item['id']);
            foreach ($comment_files as $key => $value) {
                $comments_data['comment_data']['comment_files'][$value['id']] = $value['comment_filename'];
            }
        }
        unset($comments_data[0]);
        require_once 'resources/views/article.php';
    }

    public function create(): void
    {
        $imageService = new ImageService;
        $articles = new Article();
        $data_article = $_POST;
        $data_article['article2user'] = $_SESSION['id'];

        if (!isset($_FILES)){
            if ($imageService->validateSize('article_files', $_FILES) && $imageService->validateType('article_files', $_FILES)) {
                if($articles->createArticle($data_article)) {
                    $article_id = $articles->getLastArticle();
                    if (isset($_FILES)) {
                        $dir = substr(__DIR__, 0, -15) . 'storage\articles\\';
                        foreach ($imageService->uniqImageName($_FILES['article_files']['name']) as $file) {
                            $data_article['article_files'][] = $file;
                        }

                        $data_file = array_combine($_FILES['article_files']['tmp_name'], $data_article['article_files']);
                        foreach ($data_file as $key => $value) {
                            move_uploaded_file($key, $dir . $value);
                        }

                        foreach ($data_article['article_files'] as $file) {
                            $article_file = new ArticleFile();
                            $article_file->createArticleFile($article_id['id'], $file);
                        }
                    }

                }

            }
        } else {
            $articles->createArticle($data_article);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
    
    public function update(): void
    {
        $imageService = new ImageService;
        $articles = new Article();
        $data_article = $_POST;
        $data_article['article2user'] = $_SESSION['id'];
        if (!isset($_FILES)) {
            if ($imageService->validateSize('article_files', $_FILES) && $imageService->validateType('article_files', $_FILES)) {
                $articles->updateArticle($data_article['id'], $data_article);

                $article_file = new ArticleFile();
                $data_article['article_files'] = $imageService->uniqImageName($_FILES['article_files']['name']);
                foreach ($data_article['article_files'] as $item) {
                    $article_file->createArticleFile($_POST['id'], $item);
                }


                $dir = substr(__DIR__, 0, -15) . 'storage\articles\\';
                $data_file = array_combine($_FILES['article_files']['tmp_name'], $data_article['article_files']);
                foreach ($data_file as $key => $value) {
                    move_uploaded_file($key, $dir . $value);
                }
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $articles->updateArticle($data_article['id'], $data_article);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function delete(): void
    {
        $article_file = new ArticleFile();
        $article_file->deleteArticleFiles($_POST['article_id']);

        $articles = new Article;
        $article = $articles->deleteArticle($_POST['article_id']);

        header('Location: /topic?id=' . $_POST['topic_id']);
    }
}
