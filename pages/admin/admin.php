<?php
    session_start();
    if ($_SESSION['role'] !== 2) header('Location: /index.php');
    require_once __DIR__."/../../classes/Db.php";
    require_once __DIR__."/../../classes/Products.php";

    $products = new Products(new Db);

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
        <div class="add">
            <a href="/pages/admin/add_product.php">Добавить</a>
        </div>
        <div class="products">
            <?php
            if (isset($_POST['btn-delete'])) {
                $product_id = $_POST['product_id'];
                echo $products->delete($product_id) ? "<p class='success'>Успешно удалён</p>" :  "<p class='error'>Что-то пошло не так</p>";
            }
            $data = $products->getProducts();
            foreach ($data as $product) { ?>
                <div>
                    <img src="/assets/images/product/<?= $product['path'] ?>" alt="">
                    <div>
                        <form class="title" action="" method="post">
                            <h2><?= $product['name_p'] ?></h2>
                            <div>
                                <input type="hidden" name="product_id" value="<?= $product['product_id']?>">
                                <a href="edit_product.php?id=<?=$product['product_id']?>"><img src='/assets/images/edit.png' alt=''></a>
                                <button name='btn-delete'><img src='/assets/images/delete.png' alt=''></button>
                            </div>
                        </form>
                        <div class="desc">
                            <p><?= $product['country'] ?></p>
                            <p><?= $product['category'] ?></p>
                            <p><?= $product['year'] ?></p>
                            <p><?= $product['model'] ?></p>
                        </div>
                        <div class="price">
                            <p>Количество: <?= $product['count'] ?></p>
                            <p>Цена: <?= $product['price'] ?>.00$</p>
                        </div>
                    </div>

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