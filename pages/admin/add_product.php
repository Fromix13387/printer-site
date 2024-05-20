<?php
    session_start();
if ($_SESSION['role'] !== 2) header('Location: /index.php');
    require_once "classes/Db.php";
    require_once "classes/Products.php";
    $db = new Db;
    $countries = $db->getCountries();
    $categories = $db->getCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='../../assets/css/admin/admin.css'>
    <title>Добавление принтера</title>
</head>
<body>
<div id="app">
    <?php include 'components/Top.php' ?>
    <?php include 'components/header.php' ?>
    <div class="admin">
        <?php include 'pages/admin/header.php' ?>

        <form class="form" action="#" method="post" enctype='multipart/form-data'>
            <?php
            if (isset($_POST['btn-add'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $country = $_POST['country'];
                $year = explode('-', $_POST['year'])[0];
                $model = $_POST['model'];
                $category = $_POST['category'];
                $count = $_POST['count'];
                $photo = '1.png';
                if ($price < 0) echo "<p class='error'>Цена не может быть меньше 0</p>";
                else if ($count < 0) echo "<p class='error'>Количество не может быть меньше 0</p>";
                else {
                    if (isset($_FILES['photo'])) {
                        $photo = $_FILES['photo']['name'];
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/images/product/'.$photo);
                    }
                    $products = new Products($db);
                    $answer = $products->add($name, $price,$country, $year, $model, $category, $count, $photo);

                    if ($answer) echo "<p class='success'>Принтер успешно добавлен</p>";
                    else echo "<p class='error'>Что-то пошло не так</p>";
                }
            }
            ?>

            <div>
                <label for='name'>Название</label>
                <input required name='name' type='text' placeholder='Имя'/>
            </div>
            <div>
                <label for='price'>Цена</label>
                <input required name='price' type='number' placeholder='Цена'/>
            </div>
            <div>
                <label for='country'>Страна</label>
                <select name="country">
                    <?php foreach ($countries as $country) {
                        echo "<option value='{$country['id']}'>{$country['name']}</option>";
                    } ?>
                </select>
            </div>
            <div>
                <label for='year'>Год</label>
                <input  required max='2024-01-25' min='1850-01-01' name='year' type='date' placeholder='Год'/>
            </div>
            <div>
                <label for='model'>Модель</label>
                <input required name='model' type='text' placeholder='Модель'/>
            </div>
            <div>
                <label for='category'>Категория</label>
                <select name='category'>
                    <?php foreach ($categories as $category) {
                        echo "<option value='{$category['category_id']}'>{$category['category']}</option>";
                    } ?>
                </select>
            </div>
            <div>
                <label for='count'>Количество</label>
                <input required name='count' type='number' placeholder='Количество'/>
            </div>
            <div>
                <label for='photo'>Фото</label>
                <input name='photo' type='file'/>
            </div>
            <button name='btn-add'>Добавить</button>
        </form>
    </div>
    <?php include 'components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>