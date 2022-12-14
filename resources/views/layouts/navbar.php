<div class="container">
    <nav class="navbar navbar-expand-lg bg-dark rounded">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav navbar-dark">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                    <?php $authUser = \Framework\Src\Auth\Auth::user();
                    if ($authUser) {
                        echo '<form class="d-flex position-absolute end-0 me-3" method="POST">
                        <a class="nav-link disabled" style="color:aliceblue" tabindex="-1" aria-disabled="true">' . $authUser['name'] . ' ' . $authUser['lastname'] . '</a>
                        <input type="hidden" name="logout" value="true" />
                        <button class="btn btn-outline-light" type="submit">Выйти</button>
                    </form>';  
                    } else {
                        echo '<a class="nav-link" href="/login">Авторизация</a><a class="nav-link" href="/registration">Регистрация</a>';
                    }
            
                    if ($_POST['logout']) {
                        session_destroy();
                        header('location: /');
                    } ?>
                </div>
            </div>
        </div>
    </nav>
</div>