<!doctype html>
<html lang="en">
<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.php'); ?>

    <div class="container mb-3">
        <div style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="row justify-content-end">
                    <div class="col">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Создать статью</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action list-group-item-primary mb-2" aria-current="true"><?php echo $topic['topic_name']; ?></li>
            <?php
            foreach ($article as $item) {
                echo "<li class=\"list-group-item list-group-item-action shadow-sm p-3 mb-1 bg-body\"><a class=\"link-dark\"href=\"/article?id=" . $item['id'] . "\">" . $item['article_name'] . "</a></li>";
            }
            ?>
        </ul>
    </div>

    <?php require_once('layouts/endLayout.html'); ?>