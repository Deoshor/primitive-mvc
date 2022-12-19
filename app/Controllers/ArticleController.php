<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\ArticleFile;
use App\Models\Comment;
use App\Models\CommentFile;
use App\Models\User;
use App\Services\ImageService;
use Framework\Src\Auth\Auth;

class ArticleController
{
    public $article;
    public $comment;
    public $articleFile;

    public function __construct(Article $article, Comment $comment, ArticleFile $articleFile)
    {
        $this->article = $article;
        $this->comment = $comment;
        $this->articleFile = $articleFile;
    }

    public function index(): void
    {
        $article_id = substr($_SERVER['QUERY_STRING'], 3);
        $article = $this->article->where('id', $article_id)->getArticle();

        $comment = $this->comment->where('comment2article', $article_id)->getComments();

        $article_file = new ArticleFile();
        $article_files = $article_file->where('file2article', $article['id'])->getArticleFilesById();

        $comments_data = [];
        foreach ($comment as $item) {
            $user = new User();
            $user = $user->where('id', $item['comment2user'])->getUser();
            $item['author']  = $user['name'] . ' ' . $user['lastname'];

            $comment_file = new CommentFile();
            $comment_files = $comment_file->where('file2comment', $item['id'])->getCommentFilesById();
            $item['comment_files'] = [];
            foreach ($comment_files as $file) {
                $item['comment_files'][] = $file['comment_filename'];
            }
            $comments_data[] = $item;
        }

        require_once 'resources/views/article.php';
    }

    public function create(): void
    {
        $imageService = new ImageService;
        $data_article = $_POST;
        $user = Auth::user();
        $data_article['article2user'] = $user['id'];

        if (!$_FILES['article_files']['tmp_name'][0] == ""){
            if ($imageService->validateSize('article_files', $_FILES) && $imageService->validateType('article_files', $_FILES)) {
                if($this->article->createArticle($data_article)) {
                    $article_id = $this->article->getLastArticle();
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
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->article->createArticle($data_article);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
    
    public function update(): void
    {
        $imageService = new ImageService;
        $data_article = $_POST;
        $user = Auth::user();
        $data_article['article2user'] = $user['id'];
        if (!$_FILES['article_files']['tmp_name'][0] == "") {
            if ($imageService->validateSize('article_files', $_FILES) && $imageService->validateType('article_files', $_FILES)) {
                $this->article->updateArticle($data_article['id'], $data_article);

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
            $this->article->updateArticle($data_article['id'], $data_article);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function delete(): void
    {
        $this->articleFile->deleteArticleFiles($_POST['article_id']);

        $article = $this->article->deleteArticle($_POST['article_id']);

        header('Location: /topic?id=' . $_POST['topic_id']);
    }
}
