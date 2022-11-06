<!doctype html>
<html lang="en">

<?php require_once('layouts/head.html'); ?>

<body class="antialiased">
    <?php require_once('layouts/navbar.html'); ?>

    <div class="container">
        <div style="padding-top: 20px;">
            <div class="row justify-content-center">
                <div class="col-md-7 border">
                    <h3>Авторизация</h3>
                    <form action="/login/authorize" method="POST">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" required name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Пароль</label>
                            <input type="text" required name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <button type="submit" class="btn-primary btn">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php require_once('layouts/endLayout.html'); ?>