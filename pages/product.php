<?php
    session_start();
    include_once "classes/Db.php";
    include_once "classes/Products.php";
    include_once "classes/Reviews.php";
    $db = new Db;
    $product = new Products($db);
    $reviews = new Reviews($db);
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
<body class="app">
<?php include 'components/Top.php' ?>
<?php include 'components/header.php' ?>
<div class="products">
    <?php
        if (!$data) echo '<h1>Такого товара не существует</h1>';
        else { ?>
            <div class="product">
                <img src="../assets/images/product/<?= $data['path'] ?>" alt=''>
                <div class="info">
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
                    <button>Добавить в корзину</button>
                </div>
            </div>
            <div class="reviews">
                <h1>Отзывы</h1>
                <div class="cards">
                    <?php
                    if (count($data_reviews) === 0) echo "<p>Будте первым, кто оставит отзыв</p>";
                    foreach ($data_reviews as $review) { ?>
                        <div>

                        </div>
                    <?php } ?>

                </div>
            </div>
    <?php
        }
    ?>
</div>

<?php include 'components/footer.php' ?>
</body>
</html>