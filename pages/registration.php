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
    <link rel='stylesheet' href='../assets/css/registration.css'>
    <title>Регистрация</title>
</head>
<body>
<div id="app">
    <?php include 'components/Top.php' ?>
    <?php include 'components/header.php' ?>
    <div class="registration">
        <h1>Регистрация</h1>
        <div class="form">

            <form action="#" method="post">
                <?php
                if (isset($_POST['btn-registration'])) {
                    require_once __DIR__.'/../controllers/check_fields.php';
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $patronymic = $_POST['patronymic'];
                    $login = $_POST['login'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $password_confirm = $_POST['password_confirm'];

                    $answer = check_fields($name, $surname, $patronymic, $login, $email, $password,  $password_confirm);

                    if (gettype($answer) === 'string') echo $answer;
                    else {
                        $users = $answer['users'];
                        if ($users->getUserByLogin($login)) echo "<p class='error'>Пользователь с таким логином уже есть</p>";
                        else {
                            $answer = $users->registration($name, $surname, $patronymic, $login, $email, $password);
                            if (!$answer) echo "<p class='error'>Что-то пошло не так</p>";
                            else {
                                echo "<p class='success'>Успешная регистрация</p>";
                                $_SESSION['login'] = $login;
                                header('Location: ../index.php');
                            }
                        }
                    }
                }
                if (isset($_SESSION['login'])) header('Location: ../index.php');

                ?>

                <div>
                    <label for="name">Имя</label>
                    <input name="name" type="text" placeholder="Имя"/>
                </div>
                <div>
                    <label for='surname'>Фамилия</label>
                    <input name="surname" type='text' placeholder='Фамилия'/>
                </div>
                <div>
                    <label for='patronymic'>Отчество</label>
                    <input name="patronymic" type='text' placeholder='Отчество'/>
                </div>
                <div>
                    <label for='login'>Логин</label>
                    <input name="login" type='text' placeholder='Логин'/>
                </div>
                <div>
                    <label for='email'>Почта</label>
                    <input name="email" type='email' placeholder='Почта'/>
                </div>
                <div>
                    <label for='password'>Пароль</label>
                    <input name="password" type='password' placeholder='Пароль'/>
                </div>
                <div>
                    <label for='password_confirm'>Подтверждение пароля</label>
                    <input name="password_confirm" type='password' placeholder='Подтверждение пароля'/>
                </div>
                <button name="btn-registration">Зарегистрироваться</button>
            </form>
        </div>
        <div class="auth">
            <img class="devushka" src="../assets/images/devushka.png" alt="">
            <img class="paren" src="../assets/images/paren.png" alt="">
            <p>Вы уже зарегистрированы?</p>
            <p>Тогда <a href='authorization.php'>авторизуйтесь!</a></p>
        </div>
    </div>
    <?php include 'components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>