<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Контакты</title>
    <link rel="stylesheet" href="../assets/css/contacts.css">
</head>
<body>
<div id="app">
    <?php include __DIR__.'/../components/Top.php' ?>
    <?php include __DIR__.'/../components/header.php' ?>
    <div class="contacts">
        <h1>Наши реквизиты</h1>
        <p class="description">
            Полное наименование: Общество с ограниченной ответственностью «CopyStar»<br>
            Сокращенное наименование: ООО «CopyStar»<br>
            Юридический адрес: Россия, 111111, г Челябинск, ул Гагарина, д. 7 <br>
            ОГРН: 1197847024781 <br>
            ИНН: 7813630594 <br>
            КПП: 781301001
        </p>

    </div>
    <div class="map" style='position:relative;overflow:hidden;'><a
                href='https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps'
                style='color:#eee;font-size:12px;position:absolute;top:0px;'>Челябинск</a><a
                href='https://yandex.ru/maps/56/chelyabinsk/?ll=61.402554%2C55.159897&utm_medium=mapframe&utm_source=maps&z=11'
                style='color:#eee;font-size:12px;position:absolute;top:14px;'>Яндекс Карты — транспорт, навигация, поиск
            мест</a>
        <iframe src='https://yandex.ru/map-widget/v1/?ll=61.402554%2C55.159897&z=11' width='100%' height='100%'
                frameborder='1' allowfullscreen='true' style='position:relative;'></iframe>
    </div>
    <?php include __DIR__.'/../components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>