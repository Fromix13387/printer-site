<?php
session_start();
if ($_SESSION['role'] !== 2) header('Location: /index.php');
require_once __DIR__.'/../../classes/Db.php';
require_once __DIR__.'/../../classes/Users.php';


$db = new Db;
$roles = $db->getRoles();
$users = new Users($db);

$user = $users->getUser($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../../assets/css/admin/admin.css'>
    <title>Редактирование пользователя</title>
</head>
<body>
<div id="app">
    <?php include __DIR__.'/../../components/Top.php' ?>
    <?php include __DIR__.'/../../components/header.php' ?>
    <div class="admin">
        <?php include __DIR__.'/../../pages/admin/header.php' ?>

        <?php
        if (!$user) echo "<h1 style='text-align: center; min-height: 50vh;'>Пользователь не найден</h1>";
        else { ?>
            <form class='form' action='#' method='post' enctype='multipart/form-data'>
                <?php

                if (isset($_POST['btn-add'])) {
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $patronymic = $_POST['patronymic'];
                    $email = $_POST['email'];
                    $role = $_POST['role'];

                    $answer = $users->editProfile($name, $surname, $patronymic, $email, $role,$_GET['id'] );

                    if ($answer) {
                        echo "<p class='success'>Пользователь успешно изменён</p>";
                        $user = $users->getUser($_GET['id']);
                    }
                    else echo "<p class='error'>Что-то пошло не так</p>";
                }
                ?>

                <div>
                    <label for='name'>Имя</label>
                    <input required name='name' type='text' placeholder='Имя' value="<?=$user['name_u']?>"/>
                </div>
                <div>
                    <label for='surname'>Фамилия</label>
                    <input required name='surname' type='text' placeholder='Фамилия' value="<?=$user['surname']?>"/>
                </div>
                <div>
                    <label for='patronymic'>Отчество</label>
                    <input  required name="patronymic" type="text" placeholder="Отчество" value="<?=$user['patronymic']?>">
                </div>
                <div>
                    <label for='email'>Почта</label>
                    <input required name='email' value="<?=$user['email']?>" type='email' placeholder='Почта'/>
                </div>
                <div>
                    <label for='role'>Роль</label>
                    <select name='role'>
                        <?php foreach ($roles as $role) {
                            $select = $role['id'] === $user['id_role'] ? 'selected' : '';
                            echo "<option $select  value='{$role['id']}'>{$role['name']}</option>";
                        } ?>
                    </select>
                </div>

                <button name='btn-add'>Изменить</button>
            </form>
        <?php }
        ?>


    </div>
    <?php include __DIR__.'/../../components/footer.php' ?>
</div>

<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>