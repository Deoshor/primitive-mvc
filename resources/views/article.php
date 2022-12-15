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
                    if (isset($_SESSION['user']) == $article['article2user']) {
                        echo    '<div class="col-2">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#articleEditModal">Редактировать тему</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#articleDeleteModal">Удалить статью</button>
                        </div>
                        <div class="col-8">
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="articleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактирование статьи</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="container">
                    <form action="/article/update" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <input type="text" name="article_name" class="form-control" id="article_name" value="<?php echo $article['article_name']; ?>">
                            <div class="form-text">Редактируйте название статьи</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <textarea type="text" name="article_description" class="form-control" id="article_description" required maxlength="3000"><?php echo $article['article_description']; ?></textarea>
                            <div class="form-text">Редактируйте описание статьи</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="file" name="article_files[]" multiple class="form-control" id="article_file">
                            <div class="form-text">Можно добавить фотографии в формате jpeg/png размером до 3мб</div>
                            <input type="hidden" name="id" class="form-control" id="topic_id" value="<?php echo $article['id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Редактировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="articleDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить статью?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="container">
                    <form action="/article/delete" method="POST">
                        <input type="hidden" name="article_id" class="form-control" id="article_id" value="<?php echo $article['id']; ?>">
                        <input type="hidden" name="topic_id" class="form-control" id="topic_id" value="<?php echo $article['article2topic'] ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </div>
                    </form>
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
                    <?php
                    if (!empty($article_files)) {
                        echo '<div class="row">
                                <div id="carouselArticleFade" class="col-md-8 mx-auto carousel carousel-dark slide carousel-fade mb-3 w-50" data-bs-ride="carousel">
                            <div class="carousel-inner">';
                        foreach ($article_files as $file) {
                            echo '<div class="carousel-item active">
                                    <img src="/storage/articles/' . $file['article_filename'] . '" class="d-block w-100" alt="' . $file['article_filename'] . '">
                                </div>';
                        }
                        echo '</div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselArticleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Предыдущий</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselArticleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Следующий</span>
                            </button>
                        </div>
                    </div>';
                    }
                    ?>
                


        <?php
        foreach ($comments_data as $item) {
            echo '<div class="container w-75 border border-light rounded bg-secondary bg-gradient mt-1" style="--bs-bg-opacity: .1">
                    <div class="row mt-1 mb-1">
                        <div class="col-2">
                            <strong>' . $item['author'] . '</strong>
                        </div>
                        <div class="col-3">
                            <p>' . $item['last_update_date'] . '</p>
                        </div>
                        <div class="col-6 d-flex justify-content-end">';
                        if (isset($_SESSION['user']) && $_SESSION['id'] == $item['comment2user']) {
                            echo '<a class="link-dark" href="#commentEditModal' . $item['id'] . '" data-bs-toggle="modal" data-bs-target=#commentEditModal' . $item['id'] . '>
                                <svg style="color:green" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>';
                        }
                    echo '</div>
                        <div class="col-1">';
                        if (isset($_SESSION['user']) && $_SESSION['id'] == $item['comment2user']) {
                            echo '<a class="link-dark" href="#commentDeleteModal' . $item['id'] . '" data-bs-toggle="modal" data-bs-target=#commentDeleteModal' . $item['id'] . '>
                                <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>';
                        }
                    echo '</div>
                    </div>
                    <div class="row mt-1 mb-1">
                        <div class="col-12">
                            <p>' . $item['comment'] . '</p>
                        </div>
                    </div>';        
            echo '<div class="row mt-1 mb-1">
                    <div class="col-10">';
                    if (isset($item['comment_files'])) {
                        echo '<div class="row">
                                <div id="carouselCommentFade" class="carousel carousel-dark slide carousel-fade w-50" data-bs-ride="carousel">
                                    <div class="carousel-inner">';
                        foreach ($item['comment_files'] as $image) {
                            echo '<div class="carousel-item active">
                                                <img src="/storage/comments/' . $image . '" class="d-block w-100" alt="' . $image . '">
                                            </div>';

                        }
                        echo '</div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCommentFade" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Предыдущий</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselCommentFade" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Следующий</span>
                                </button>
                            </div>
                        </div>';
                    }
                echo '</div>
                </div>
            </div>';
            echo '<div class="modal fade" id="commentDeleteModal' . $item['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Удалить комментарий?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                            <div class="container">
                                <form action="/comment/delete" method="POST">
                                    <input type="hidden" name="article_id" class="form-control" id="article_id" value="' . $article['id'] . '">
                                    <input type="hidden" name="comment_id" class="form-control" id="comment_id" value="' . $item['id'] . '">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            echo '<div class="modal fade" id="commentEditModal' . $item['id'] . '" tabindex="-1" aria-labelledby="articleModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Редактирование комментария</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                            <div class="container">
                                <form action="/comment/update" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3 mt-3">
                                        <textarea type="text" name="comment" class="form-control" id="comment" required maxlength="3000">' . $item['comment'] . '</textarea>
                                        <div class="form-text">Редактируйте комментарий к статье</div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <input type="file" name="comment_files[]" multiple class="form-control" id="article_file">
                                        <div class="form-text">Можно загрузить фотографию в формате jpeg/png размером до 3мб</div>
                                        <input type="hidden" name="id" class="form-control" id="comment_id" value="' . $item['id'] . '">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button type="submit" class="btn btn-success">Редактировать</button>
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>';
        }
        ?>
            
    
    <div class="container mb-3">
        <div style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo    '<div class="col-3">
                            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#commentModal">Оставить комментарий</button>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="articleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новый комментарий</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="container">
                    <form action="/comment/create" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <textarea type="text" name="comment" class="form-control" id="comment"></textarea>
                            <div class="form-text">Введите комментарий к статье</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="file" name="comment_files[]" multiple class="form-control" id="article_file">
                            <div class="form-text">Можно загрузить фотографию в формате jpeg/png размером до 3мб</div>
                            <input type="hidden" name="comment2article" class="form-control" id="article_id" value="<?php echo $article['id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>

    <?php require_once('layouts/endLayout.html'); ?>