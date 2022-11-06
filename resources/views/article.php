<!doctype html>
<html lang="en">
<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.html'); ?>


    <div class="container">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action list-group-item-primary mb-2 mt-1" aria-current="true"><?php echo $article['article_name']; ?></li>
        </ul>
        <div class="container">
            <div class="card-body mb-3">
                <?php echo $article['article_description']; ?>
            </div>
        </div>

        <?php
        foreach ($comments_data as $item) {
            echo '<div class="container border border-dark rounded bg-warning bg-gradient mb-1" style="--bs-bg-opacity: .3">
                        <div class="container p-1">
                            <strong>' . $item['author'] . '</strong>
                            <p>' .$item['comment'] . '</p>
                        </div>
                    </div>';
        }
        ?>
    </div>

    <?php require_once('layouts/endLayout.html'); ?>