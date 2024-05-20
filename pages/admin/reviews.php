<?php
session_start();
if ($_SESSION['role'] !== 2) header('Location: /index.php');
require_once 'classes/Db.php';
require_once 'classes/Reviews.php';

$reviews = new Reviews(new Db);

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
        <div class="reviews">
            <?php
            if (isset($_POST['btn-delete'])) {
                $review_id = $_POST['review_id'];
                echo $reviews->delete($review_id) ? "<p class='success'>Отзыв удалён</p>" : "<p class='error'>Что-то пошло не так</p>";
            }

            $data = $reviews->getReviews();
            foreach ($data as $review) { ?>
            <div>
                <div>
                    <h2><?= $review['surname'] ?> <?= $review['name_u'] ?> <?= $review['patronymic'] ?></h2>
                    <p class='date'><?= $review['date'] ?></p>
                </div>
                <p><strong><?= $review['name'] ?></strong></p>
                <p><?= $review['value'] ?></p>
                <form class='review_form' action='' method='post'>
                    <input type='hidden' name='review_id' value='<?=$review['id']?>'>
                    <button name='btn-delete'><img src='/assets/images/delete.png' alt=''></button>
                </form>
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