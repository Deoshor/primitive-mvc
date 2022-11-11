<!doctype html>
<html lang="en">
<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.php'); ?>

    <div class="container mb-3">
        <div style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="row justify-content-end">
                    <?php
                    if (isset($_SESSION['email']) && $_SESSION['id'] == $article['article2user']) {
                        echo    '<div class="col-2">
                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#articleModal">Редактировать статью</button>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#articleModal">Удалить статью</button>
                        </div>
                        <div class="col-8">
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4">
        <div class="row bg-light bg-gradient border rounded shadow-sm p-3 mb-2">
            <div class="col-12"><?php echo $article['article_name']; ?></div>
        </div>
        <div class="card-body mb-3">
            <?php echo $article['article_description']; ?>
        </div>
        <div class="row">
            <div id="carouselArticleFade" class="col-md-8 mx-auto carousel slide carousel-fade mb-3 w-50" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselArticleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselArticleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselArticleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/storage/articles/Toyota.png" class="d-block w-100" alt="Toyota">
                    </div>
                    <div class="carousel-item">
                        <img src="/storage/articles/Toyota Crown.jpg" class="d-block w-100" alt="Toyota Crown">
                    </div>
                    <div class="carousel-item">
                        <img src="/storage/articles/Toyota Cresta.jpg" class="d-block w-100" alt="Toyota Cresta">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselArticleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselArticleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
            </div>
        </div>


        <?php
        foreach ($comments_data as $item) {
            echo '<div class="row border border-light rounded bg-secondary bg-gradient mt-1 mb-1" style="--bs-bg-opacity: .1">
                        <div class="col-10 p-1">
                            <strong>' . $item['author'] . '</strong>
                            <p>' . $item['comment'] . '</p>
                        </div>';
            if ($_SESSION['id'] == $item['comment2user']) {
                echo '<div class="col-1 p-1">
                    <a class="link-dark" href=/comment/edit?id=' . $item['id'] . '>
                        <svg style="color:green" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-1 p-1">
                    <a class="link-dark" href=/comment/delete?id=' . $item['id'] . '>
                        <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </div>';   
            }         
            echo '</div>';
        }
        ?>
    </div>
    <div class="container mb-3">
        <div style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo    '<div class="col-3">
                            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#commentModal">Оставить комментарий</button>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



    <?php require_once('layouts/endLayout.html'); ?>