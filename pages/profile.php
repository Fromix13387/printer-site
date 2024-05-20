<?php
    session_start();

    require_once __DIR__ . '/../classes/Db.php';
    require_once __DIR__ . '/../classes/Users.php';
    require_once __DIR__ . '/../classes/Orders.php';
    $db = new Db;
    $users = new Users($db);
    $orders = new Orders($db);
    $orders_data = $orders->getAllByLogin($_SESSION['login'])
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Мой профиль</title>
</head>
<body>
<div id="app">
    <?php include 'components/Top.php' ?>
    <?php include 'components/header.php' ?>
    <div class="profile">
        <h1>Профиль</h1>
        <form action="#" method="post">
            <?php
            if (isset($_POST['btn-edit'])) {
                require_once __DIR__ . '/../controllers/check_fields.php';
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $patronymic = $_POST['patronymic'];
                $login = $_POST['login'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];

                $answer = check_fields($name, $surname, $patronymic, $login, $email, $password, $password_confirm, 'edit');
                if (gettype($answer) === 'string') echo $answer;
                else {
                    if ($_SESSION['login'] !== $login && $users->getUserByLogin($login)) echo "<p class='error'>Пользователь с таким логином уже есть</p>";
                    else {
                        $answer = $users->edit($name, $surname, $patronymic, $login, $email, $password, $_SESSION['login']);
                        if (!$answer) echo "<p class='error'>Что-то пошло не так</p>";
                        else {
                            echo "<p class='success'>Успешно изменили данные</p>";
                            $_SESSION['login'] = $login;
                            header('Location: ../pages/profile.php');
                        }
                    }
                }
            }
            if (!isset($_SESSION['login'])) header('Location: ../index.php');
            $user = $users->getUserByLogin($_SESSION['login'])
            ?>

            <div>
                <label for='name'>Имя</label>
                <input value="<?= $user['name'] ?>" name='name' type='text' placeholder='Имя'/>
            </div>
            <div>
                <label for='surname'>Фамилия</label>
                <input value="<?= $user['surname'] ?>" name='surname' type='text' placeholder='Фамилия'/>
            </div>
            <div>
                <label for='patronymic'>Отчество</label>
                <input value="<?= $user['patronymic'] ?>" name='patronymic' type='text' placeholder='Отчество'/>
            </div>
            <div>
                <label for='login'>Логин</label>
                <input value="<?= $user['login'] ?>" name='login' type='text' placeholder='Логин'/>
            </div>
            <div>
                <label for='email'>Почта</label>
                <input value="<?= $user['email'] ?>" name='email' type='email' placeholder='Почта'/>
            </div>
            <div>
                <label for='password'>Пароль</label>
                <input name='password' type='password' placeholder='Пароль'/>
            </div>
            <div>
                <label for='password_confirm'>Подтверждение пароля</label>
                <input name='password_confirm' type='password' placeholder='Подтверждение пароля'/>
            </div>
            <button name='btn-edit'>Редактировать</button>
        </form>
        <h1>История покупок</h1>
        <div class="order">
            <?php
            if (count($orders_data) <= 0) echo "<p>Совершите покупку и здесь появятся товары</p>";
            foreach ($orders_data as $order) { ?>
                <div>
                    <img src="/assets/images/product/<?= $order['path'] ?>" alt="">
                    <div>
                        <div>
                            <h1><?= $order['name_p'] ?></h1>
                            <p><?= $order['created_at'] ?></p>
                        </div>
                        <p>Цена: <?= $order['price'] ?>.00$</p>
                        <p>Количество: <?= $order['count_or'] ?> шт</p>
                        <p>Стоимость: <?= $order['count_or'] * $order['price'] ?> .00$</p>
                        <p>Статус: <?= $order['status'] ?></p>
                    </div>
                </div>
             <?php   }
            ?>

        </div>
    </div>
    <?php include 'components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>