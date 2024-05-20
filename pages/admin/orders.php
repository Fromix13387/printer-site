<?php
session_start();
if ($_SESSION['role'] !== 2) header('Location: /index.php');
require_once 'classes/Db.php';
require_once 'classes/Orders.php';

$orders = new Orders(new Db);

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
    <?php include 'components/Top.php' ?>
    <?php include 'components/header.php' ?>
    <div class="admin">
        <?php include 'pages/admin/header.php' ?>
        <div class="orders">
            <?php
            if (isset($_POST['btn-reject'])) {
                $user_id = $_POST['order_id'];
                echo $orders->reject($user_id) ? "<p class='success'>Заказ отменён</p>" : "<p class='error'>Что-то пошло не так</p>";
            }
            else if (isset($_POST['btn-accept'])) {
                $user_id = $_POST['order_id'];
                echo $orders->accept($user_id) ? "<p class='success'>Заказ принят</p>" : "<p class='error'>Что-то пошло не так</p>";
            }
            $data = $orders->getOrders();
            foreach ($data as $order) { ?>
                <div>
                    <img class="order-img" src="/assets/images/product/<?= $order['path'] ?>" alt=''>
                    <div>
                        <div>
                            <p>Покупатель: <strong><?= $order['name_u'] ?> <?= $order['surname']  ?> <?= $order['patronymic'] ?></strong></p>
                            <p><?= $order['created_at_or'] ?></p>
                        </div>
                        <p>Принтер: <strong> <?= $order['name_p'] ?></strong></p>
                        <p>Цена: <?= $order['price'] ?>.00$</p>
                        <p>Количество: <strong><?= $order['count_or'] ?> шт</strong></p>
                        <p>Стоимость: <?= $order['count_or'] * $order['price'] ?> .00$</p>
                        <p>Статус: <strong><?= $order['status'] ?></strong></p>
                        <?php
                            if (mb_strtolower($order['status']) === 'новый') echo " <form class='order_form' action='' method='post'>  <input type='hidden' name='order_id' value='{$order['order_id']}'>
                        <button name='btn-accept'><img src='/assets/images/accept.png' alt=''></button>
                        <button name='btn-reject'><img src='/assets/images/delete.png' alt=''></button>
                        </form>"
                        ?>

                    </div>

                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php include 'components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>