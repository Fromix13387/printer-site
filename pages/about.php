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
    <link rel='stylesheet' href='../assets/css/about.css'>
    <title>О нас</title>
</head>
<body>
<div id="app">
    <?php include __DIR__.'/../components/Top.php' ?>
    <?php include __DIR__.'/../components/header.php' ?>
    <div class="about">
        <h1>О компании Copy star</h1>

        <div class="description">
            <p>Copy Star - это современная компания, специализирующаяся на оказании широкого спектра услуг в области печати и копировальных работ. Мы обеспечиваем наших клиентов качественными и профессиональными услугами, используя только самые современные технологии и оборудование.
            </p>
            <p>Copy Star была основана в 2005 году и за долгие годы успешной работы на рынке печатных услуг компания завоевала репутацию надежного и профессионального партнера для своих клиентов. Мы постоянно совершенствуем свои услуги, следуя новейшим технологиям и требованиям рынка.</p>
        </div>
        <div class="image">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <img src="../assets/images/woman.png" alt="">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
        <div class="description-down">
            <div class="description">
                <p>Компания Copy Star всегда открыта для талантливых и целеустремленных специалистов, которые разделяют нашу страсть к качеству и профессионализму. Мы ценим талантливых сотрудников и всегда ищем новые таланты, готовых присоединиться к нашей дружной команде. Если вы заинтересованы в карьере в области печати и готовы присоединиться к нам, пожалуйста, свяжитесь с нами для уточнения возможных вакансий.</p>
                <p>Наша команда состоит из опытных специалистов, готовых помочь вам в реализации любых проектов, будь то печать документов, изготовление брошюр, флаеров или других видов рекламной продукции.</p>
                <p>Мы стремимся к безупречному качеству и кратчайшим срокам выполнения заказов, чтобы наши клиенты могли быть уверены в надежности и эффективности наших услуг.</p>
                <p>Доверьте свои задачи по печати команде Copy Star - мы создадим для вас работу высочайшего качества, которой можно доверять!</p>
            </div>
        </div>
    </div>

    <?php include __DIR__.'/../components/footer.php' ?>
</div>
<script src='/assets/js/vue.global.js'></script>
<script src='/assets/js/main.js'></script>
</body>
</html>
