<?php
session_start();
if ($_SESSION['role'] !== 2) header('Location: /index.php');
require_once __DIR__.'/../../classes/Db.php';
require_once __DIR__.'/../../classes/Users.php';

$users = new Users(new Db);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../../assets/css/admin/admin.css'>
    <title>Админ панель</title>
</head>
<body>
<div id="app">
    <?php include __DIR__.'/../../components/Top.php' ?>
    <?php include __DIR__.'/../../components/header.php' ?>
    <div class="admin">
        <?php include __DIR__.'/../../pages/admin/header.php' ?>
        <div class="users">
            <?php
            if (isset($_POST['btn-delete'])) {
                $user_id = $_POST['user_id'];
                echo $users->delete($user_id) ? "<p class='success'>Успешно удалён</p>" : "<p class='error'>Что-то пошло не так</p>";
            }
            $data = $users->getUsers();
            foreach ($data as $user) { ?>
                <div>
                    <p>ФИО: <?= $user['name_u'] ?> <?= $user['surname']  ?> <?= $user['patronymic'] ?></p>
                    <p>Логин: <?= $user['login'] ?></p>
                    <p>Почта: <?= $user['email'] ?></p>
                    <p>Роль: <?= $user['role'] ?></p>
                    <form class="users_form" action="" method="post">

                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <a href="edit_user.php?id=<?= $user['user_id'] ?>"><img
                                    src='/assets/images/edit.png' alt=''></a>
                        <button name='btn-delete'><img src='/assets/images/delete.png' alt=''></button>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php include __DIR__.'/../../components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>