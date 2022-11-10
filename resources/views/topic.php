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


    <div class="container px-4">
        <div class="row bg-light bg-gradient border rounded shadow-sm p-3 mb-2">
            <div class="col-12"><?php echo $topic['topic_name']; ?></div>
        </div>
        <?php
        foreach ($article as $item) {
            echo '<div class="row border border-dark rounded shadow-sm p-3 mb-1">
                        <div class="col-10">
                            <a class="link-dark" href=/article?id=' . $item['id'] . ">" . $item['article_name'] . '</a>
                        </div>
                    </div>';

        }
        ?>
    </div>

    <?php require_once('layouts/endLayout.html'); ?>