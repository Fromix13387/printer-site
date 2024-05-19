<?php
    session_start();
    include_once "classes/Db.php";
    include_once "classes/Products.php";
    include_once "classes/Reviews.php";
    $db = new Db;
    $product = new Products($db);
    $reviews = new Reviews($db);

    if (isset($_POST['btn-add-review'])) {
        $value = $_POST['value'];
        $id_product = $_POST['id_product'];
        $reviews->add($value, $id_product, $_SESSION['login']);
    }

    $data = $product->getProduct($_GET['id'] ?? '');
    $data_reviews = $reviews->getReviewsByProduct($data['product_id']);
?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Товар</title>
    <link rel='stylesheet' href='../assets/css/product.css'>

</head>
<body>
<div id="app">
    <?php include 'components/Top.php' ?>
    <?php include 'components/header.php' ?>
    <div class="products">
        <?php
        if (!$data) echo '<h1>Такого товара не существует</h1>';
        else { ?>
            <div class="product">
                <img src="../assets/images/product/<?= $data['path'] ?>" alt=''>
                <div :class="'activeEl'" class="info noneEl">
                    <div>
                        <h1><?= $data['name_p'] ?></h1>
                        <div>
                            <h2>Характеристики</h2>
                            <div>
                                <p>год......................................<?= $data['year'] ?></p>
                                <p>модель.............................<?= $data['model'] ?></p>
                                <p>страна...............................<?= $data['country'] ?></p>
                                <p>категория........................<?= $data['category'] ?></p>
                            </div>
                            <h2 class="price"><?= $data['price'] ?>.00$</h2>
                        </div>
                    </div>
                    <button v-if="getProductCount(<?= $data['product_id'] ?>) === 0"
                            @click="add(<?= $data['product_id'] ?>)">Добавить в корзину
                    </button>
                    <div v-cloak class="numeric" v-else>
                        <p class="btn" @click="remove(<?= $data['product_id'] ?>)">-</p>
                        <p>{{getProductCount(<?= $data['product_id'] ?>)}}</p>
                        <p class="btn" @click="add(<?= $data['product_id'] ?>)">+</p>
                    </div>
                </div>
            </div>
            <div class="reviews">
                <h1>Отзывы</h1>
                <div class="cards">
                    <?php
                    if (count($data_reviews) === 0) echo '<p>Будте первым, кто оставит отзыв</p>';
                    foreach ($data_reviews as $review) { ?>
                        <div>
                            <div>
                                <h2><?= $review['surname'] ?> <?= $review['name'] ?> <?= $review['patronymic'] ?></h2>
                                <p class='date'><?= $review['date'] ?></p>
                            </div>
                            <p><?= $review['value'] ?></p>

                        </div>
                    <?php } ?>

                </div>
                <?php
                if (isset($_SESSION['login'])) { ?>

                    <form class="add-review" method="post" action="#">
                        <input type="hidden" name="id_product" value="<?= $data['product_id'] ?>">
                        <textarea required name="value" rows="10" placeholder="Описание..."></textarea>
                        <button name="btn-add-review">Опубликовать</button>
                    </form>
                    <?php
                }
                ?>

            </div>
            <?php
        }
        ?>
    </div>

    <?php include 'components/footer.php' ?>

</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>