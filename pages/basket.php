<?php
    session_start();
    if (!isset($_SESSION['login'])) header('Location: ../index.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../assets/css/basket.css'>
    <title>Корзина</title>
</head>
<body>
<div id="app">
    <?php include 'components/Top.php' ?>
    <?php include 'components/header.php' ?>
   <div class="bask">
       <basket @update-storage="updateStorage"/>

   </div>

    <?php include 'components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>