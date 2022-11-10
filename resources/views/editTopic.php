<!doctype html>
<html lang="en">

<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.php'); ?>

    <?php
    echo '<div class="container">
    <div style="padding-top: 20px;">
        <div class="row justify-content-center">
            <div class="col-md-7 border">
                <h2>Редактирование темы</h2>
                <form action="/topic/update" method="POST">
                    <div class="form-group mt-3">
                        <input type="text" required name="topic_name" class="form-control" placeholder="' . $topic['topic_name'] . '">
                        <input type="hidden" name="topic_id" class="form-control" value="' . $topic['id'] . '">
                    </div>
                    <div class="form-group mt-3 mb-2">
                        <button type="submit" class="btn-success btn">Редактировать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
    ?>

    </div>

    <?php require_once('layouts/endLayout.html'); ?>