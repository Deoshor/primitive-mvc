<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Темы блога</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
</head>
<body class="antialiased">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Авторизация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/registration">Регистрация</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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



<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>