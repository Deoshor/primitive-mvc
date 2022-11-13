<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Services\ImageService;

class ArticleController
{
    public function index()
    {
        $articles = new Article();
        $article = $articles->getArticle($_SERVER['QUERY_STRING']);

        $comments = new Comment();
        $comment = $comments->getComments($_SERVER['QUERY_STRING']);

        $comments_data = [];
        array_push($comments_data, $comment['last_update_date']);
        foreach ($comment as $item) {
            $user = new User();
            $user = $user->getUser($item['comment2user']);
            $item['author']  = $user['name'] . ' ' . $user['lastname'];
            array_push($comments_data, $item);
        }
        unset($comments_data[0]);
        require_once 'resources/views/article.php';
    }

    public function create()
    {
        $imageService = new ImageService;
        if ($imageService->validateSize($_FILES) && $imageService->validateType($_FILES)) {
            $articles = new Article();
            $data_article = $_POST;
            $data_article['article2user'] = $_SESSION['id'];
            $data_article['article_files'] = $imageService->uniqImageName($_FILES['article_files']['name']);
            $article = $articles->createArticle($data_article);
            $dir = substr(__DIR__, 0, -15) . 'storage\articles\\';
            

            $data_file = array_combine($_FILES['article_files']['tmp_name'], $data_article['article_files']);
            foreach ($data_file as $key => $value) {
                move_uploaded_file($key, $dir . $value);
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function edit()
    {
        $articles = new Article;
        $article = $articles->getArticleById($_REQUEST['id']);
        require_once 'resources/views/editArticle.php';
    }

    public function update()
    {
        $imageService = new ImageService;
        if ($imageService->validateSize($_FILES) && $imageService->validateType($_FILES)) {
            $articles = new Article();
            $data_article = $_POST;
            $data_article['article2user'] = $_SESSION['id'];
            $data_article['article_files'] = $imageService->uniqImageName($_FILES['article_files']['name']);
            $images = $articles->getImages($_POST['id']);
            $article = $articles->updateArticle($data_article['id'], $data_article, $images);
            
            
            $dir = substr(__DIR__, 0, -15) . 'storage\articles\\';
            $data_file = array_combine($_FILES['article_files']['tmp_name'], $data_article['article_files']);
            foreach ($data_file as $key => $value) {
                 move_uploaded_file($key, $dir . $value);
             }
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function delete()
    {
        $articles = new Article;
        $article = $articles->deleteArticle($_POST['article_id']);
        header('Location: /topic?id=' . $_POST['topic_id']);
    }
}
