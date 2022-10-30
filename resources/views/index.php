<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи</title>
</head>
<body>
    <h3>Список пользователей</h3>
    <?php foreach($users as $user){
        echo "<p>" . $user[1] . ' ' . $user[2] . "</p>";
        if($user[3]){
            echo '<img width="100" src="/storage/' . $user[3] . '">';
        }
    }
    ?>
    <hr>
    <h3>Создание пользователей</h3>
    <form action="users/store" method="POST" enctype="multipart/form-data">
    <label for="name">Имя</label>
    <input type="text" name="name" id="name" placeholder="Имя">
    <label for="lastname">Фамилия</label>
    <input type="text" name="lastname" id="lastname" placeholder="Фамилия">
    <input type="file" name="file">
    <button type="submit">Создать</button>
    </form>
</body>
</html>