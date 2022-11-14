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
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo    '<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#articleModal">
                                        Создать статью
                                    </button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="articleModal" tabindex="-1" aria-labelledby="articleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новая статья</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="container">
                    <form action="/article/create" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <input type="text" name="article_name" class="form-control" id="article_name" required>
                            <div class="form-text">Введите заголовок предлагаемой статьи</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <textarea type="text" name="article_description" class="form-control" id="article_description" required maxlength="3000"></textarea>
                            <div class="form-text">Введите описание статьи</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="file" name="article_files[]" multiple class="form-control" id="article_file">
                            <div class="form-text">Можно загрузить фотографию в формате jpeg/png размером до 3мб</div>
                            <input type="hidden" name="article2topic" class="form-control" id="topic_id" value="<?php echo $topic['id']; ?>">
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
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
    <?php require_once('layouts/endLayout.html'); ?>