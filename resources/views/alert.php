<!doctype html>
<html lang="en">
<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.php'); ?>

    <?php
    echo '<div class="container">
            <div style="padding-top: 20px;">
                <div class="alert alert-danger" role="alert">' . $alert .
        '</div>
            </div>
        </div>';
    ?>

<?php if (isset($_REQUEST['article_name'])) {
    echo '<div class="container mb-3">
        <div style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="row justify-content-end">
                    <div class="col">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#articleModal">  
                            <a href="/topic?id=' . $_REQUEST['topic_id'] . '">Вернуться</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}
?>


    <?php require_once('layouts/endLayout.html'); ?>