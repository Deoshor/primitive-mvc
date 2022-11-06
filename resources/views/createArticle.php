<!doctype html>
<html lang="en">
<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.html'); ?>

    <div class="container">
        <div style="padding-top: 20px;">
            <div class="col-md-12">
                <h4 class="display-6">Создание статьи</h4>
            </div>
            <form action="/articles/create" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="name">Название</span>
                    <input type="text" required name="article_name" placeholder="Название статьи" class="form-control" aria-label="Название статьи" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="description">Описание статьи</span>
                    <textarea type="text" required name="article_description" class="form-control-plaintext border-bottom"></textarea>
                </div>
                <h4>Картинки</h4>
                <div class="input-group mb-3">
                    <input type="file" multiple name="article_file[]" class="form-check" id="inputGroupFile02">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>

    </div>

    <?php require_once('layouts/endLayout.html'); ?>