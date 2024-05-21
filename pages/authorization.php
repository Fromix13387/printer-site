<?php
    session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../assets/css/authorization.css'>
    <title>Авторизация</title>
</head>
<body>
<div class="app">
    <?php include __DIR__.'/../components/Top.php' ?>
    <?php include __DIR__.'/../components/header.php' ?>

    <div class="authorization">
        <h1>Авторизация</h1>
        <form action="#" method="post">
            <?php
            if (isset($_POST['btn-authorization'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];

                require_once __DIR__ . '/../classes/Db.php';
                require_once __DIR__ . '/../classes/Users.php';

                $user = new Users(new Db);
                $data = $user->getUserByLogin($login);
                if ($data && password_verify($password, $data['password'])) {
                    echo "<p class='success'>Успешно вошли</p>";
                    $_SESSION['login'] = $data['login'];
                    $_SESSION['role'] = $data['id_role'];
                } else {
                    echo "<p class='error'>Неправильный логин или пароль</p>";
                }
            }
            if (isset($_SESSION['login'])) header('Location: ../index.php');
            ?>

            <div>
                <label for='login'>Логин</label>
                <input name='login' type='text' placeholder='Логин'/>
            </div>
            <div>
                <label for='password'>Пароль</label>
                <input name='password' type='password' placeholder='Пароль'/>
            </div>
            <button name='btn-authorization'>Войти</button>
            <div>
                <p>У вас нету аккаунта ?</p>
                <p>Тогда <a href="registration.php">зарегистрируйтесь!</a></p>
            </div>
        </form>
    </div>
    <?php include __DIR__.'/../components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>