<?php
$url = $_SERVER['REQUEST_URI'];

if (isset($_SESSION['login']) && isset($_POST['btn-leave'])) unset($_SESSION['login']);
?>

<link rel='stylesheet' href='../assets/css/components/header.css'>
<div class="header">
    <div class="nav">
        <a class="<?= $url === '/index.php' ? 'active' : '' ?>" href="../index.php#catalog">Каталог</a>
        <a class="<?= $url === '/pages/about.php' ? 'active' : '' ?>" href="../pages/about.php">О нас</a>
        <a class="<?= $url === '/pages/contacts.php' ? 'active' : '' ?>" href="../pages/contacts.php">Контакты</a>
    </div>


    <?php
        if (isset($_SESSION['login'])) { ?>
            <form class='prof' method="post" action="#">
                <a href='../pages/profile.php'><?= $_SESSION['login'] ?></a>
                <button name="btn-leave">Выйти</button>
<!--                <a href='../pages/registration.php'>Зарегистрироваться</a>-->
            </form>
     <?php
        }
        else { ?>
            <div class='auth'>
                <a href='../pages/authorization.php'>Войти</a>
                <a href='../pages/registration.php'>Зарегистрироваться</a>
            </div>
    <?php
        }
    ?>
</div>
