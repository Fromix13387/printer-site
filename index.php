<?php
session_start();
include __DIR__.'/classes/Db.php';
include __DIR__.'/classes/Products.php';
$products = new Products(new Db);
$row = $products->getProducts();
$data = '';
for ($i = 0; $i < 5 && $i < count($row); $i++) {
    $data .= sprintf('
			<div class="embla__slide">
				<div>
                    <img src="/assets/images/product/%s" alt="">
                        <div>
                            <h1>%s</h1>
                            <p class="price">%s.00 $</p>
                            <div>
                                <p>%s</p>
                                <p>%s</p>                  
                            </div>
                            <a href="/pages/product.php?id=%s">Посмотреть...</a>
                        </div>
                </div>
			</div>
		', $row[$i]['path'], $row[$i]['name_p'], $row[$i]['price'], $row[$i]['year'], $row[$i]['model'], $row[$i]['product_id']);
}
if ($data == '') $data = '<h3 class="text-center">Товары отсутствуют</h3>';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Интернет-магазин</title>
    <style>
        .embla {
            margin: auto;
            max-width: 100%;
            /*max-width: 70rem;*/
            --slide-height: 19rem;
            --slide-spacing: 1rem;
            --slide-size: 100%;
            --slide-spacing-sm: 2rem;
            --slide-size-sm: 50%;
            --slide-spacing-lg: 2rem;
            --slide-spacing-llg: 4rem;
            --slide-size-lg: calc(100% / 3);
        }
        .embla__viewport {
            overflow: hidden;
        }
        .embla__container {
            backface-visibility: hidden;
            display: flex;
            touch-action: pan-y pinch-zoom;
            margin-left: calc(var(--slide-spacing) * -1);
        }
        .embla__slide {
            min-width: 0;
            flex: 0 0 var(--slide-size);
            padding-left: var(--slide-spacing);
        }
        @media (min-width: 750px) {
            .embla__slide {
                flex: 0 0 var(--slide-size-sm);
                padding-left: var(--slide-spacing-sm);
            }
            .embla__container {
                margin-left: calc(var(--slide-spacing-sm) * -1);
            }
        }
        @media (min-width:  1300px) {
            .embla {

            }
            .embla__slide {
                flex: 0 0 var(--slide-size-lg);
                padding-left: var(--slide-spacing-lg);
            }

            .embla__container {
                margin-left: calc(var(--slide-spacing-lg) * -1);
            }
        }
        @media (min-width:  1500px) {
            .embla__slide {
                padding-left: var(--slide-spacing-llg);
            }

            .embla__container {
                margin-left: calc(var(--slide-spacing-llg) * -1);
            }
        }
        .embla__dots {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            /*margin-right: calc((2.6rem - 1.4rem) / 2 * -1);*/
        }
        .embla__dot {
            -webkit-appearance: none;
            appearance: none;
            background-color: transparent;
            touch-action: manipulation;
            text-decoration: none;
            cursor: pointer;
            border: 0;
            padding: 0;
            margin: 0;
            width: 3.5rem;
            height: 2.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .embla__dot:after {
            background-color: #614748;
            width: 2.5rem;
            transition: background-color 0.5s ease;
            height: 0.3rem;
            border-radius: 50px;
            display: flex;
            align-items: center;
            content: '';
        }
        .embla__dot:hover:after{
            background-color: #cb39a4;
        }
        .embla__dot--selected:after {
            background-color: #BF148F;
        }
    </style>
</head>
<body>
   <div id="app">
       <?php include __DIR__.'/components/Top.php' ?>
       <?php include __DIR__.'/components/header.php' ?>
       <div class="main">
           <h1>Новинки компании</h1>
           <section class='embla'>
               <div class='embla__viewport slider1'>
                   <div class='embla__container'>
                       <?= $data ?>
                   </div>
                   <div class='embla__dots'></div>
               </div>
           </section>
       </div>
       <div class="main">
           <div class="description-printer ">
               <img src='assets/images/printer.png' alt=''>
               <div>
                   <h1>Принтеры</h1>
                   <p>Cо дня изобретения первого в мире принтера и его запуска в массовое производство, прошел не один
                       десяток лет. Технологии печати за этот период сильно продвинулись вперёд, но суть принтеров и их
                       предназначение не потерпели особых изменений.
                       Принтеры, которые окружают нас сейчас – это высокотехнологичные, современные устройства, позволяющие
                       печатать практически на чем угодно: бумаге, картоне, пленках и т.д.</p>
                   <img class="star" src="assets/images/star.png" alt="">
               </div>
           </div>
       </div>
       <div class="main">
           <div class="description">

               <p class="description-p"><img class='arrow' src='assets/images/arrow.png' alt=''>Первые принтера были роскошью, недоступной обычному пользователю, стоили огромных денег и занимали немало места, поэтому позволить печатающее устройство могли только крупные компании. </p>
               <p class="description-p"><img class='person' src='assets/images/person.png' alt=''>
                   Прошло не так много времени, как наш мир шагнул в век технологий и принтер стал обыденностью даже для домохозяйки и людей почтенного возраста, не говоря уже о компаниях и производствах. В разрезе времени все принтеры улучшались и упрощались, для их удобного пользования.
                   Принтер в офис, для дома, для дачи, для повседневных задач
               </p>
           </div>
       </div>
       <div class="main">
           <div class="description-printer description-second">
               <img src="assets/images/person2.png" alt="">
               <p>Мы продаём самые востребованные на сегодняшний день печатающие устройства, про их плюсы и минусы мы рассказали подробно в каждой статье про «лазерные принтеры» и про их основных конкурентов «струйные принтеры». Настоятельно рекомендуем, прочитать эти две статьи, чтобы окончательно определить и остановить выбор именно на том устройстве, который подойдёт для вас по всем критериям отбора. Благодаря правильному и точному выбору вы не переплатите лишние деньги за те функции принтера, которые вам не пригодятся. Наш каталог имеет удобные фильтры подбора принтера для ваших нужд, он расположен слева от каталога, также есть простой и быстрый, интуитивно-понятный визуальный подбор печатающего устройства.</p>
           </div>
       </div>
       <div class="main " id="app2">
           <div class="catalog">
               <h1 id="catalog">Каталог</h1>
               <div class='products'>
                   <?php

                   foreach ($row as $item) {
                       $str = isset($_SESSION['login']) ? ":class='{activeProduct: getProductCount({$item['product_id']}) > 0 }'" : '';?>
                       <div class="card" <?=$str?>>
                           <img src="/assets/images/product/<?=$item['path']?>" alt="">
                           <div>
                               <h1><?= $item['name_p'] ?></h1>
                               <p class="price"><?=$item['price']?>.00 $</p>
                               <div>
                                   <p><?= $item['year'] ?></p>
                                   <p><?= $item['model'] ?></p>
                               </div>
                               <a href="/pages/product.php?id=<?=$item['product_id']?>">Купить</a>
                           </div>
                       </div>
                       <?php
                   }
                   ?>

               </div>
           </div>
       </div>
       <?php include __DIR__.'/components/footer.php' ?>
   </div>
   <script src='/assets/js/vue.global.js'></script>
   <script src='/assets/js/main.js'></script>
    <script src='https://unpkg.com/embla-carousel/embla-carousel.umd.js'></script>
    <script src='https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js'></script>
    <script type='text/javascript'>

        const addDotBtnsAndClickHandlers = (emblaApi, dotsNode) => {
            let dotNodes = []
            const addDotBtnsWithClickHandlers = () => {
                dotsNode.innerHTML = emblaApi
                    .scrollSnapList()
                    .map(() => '<button class="embla__dot" type="button"></button>')
                    .join('')

                const scrollTo = (index) => {
                    emblaApi.scrollTo(index)
                }

                dotNodes = Array.from(dotsNode.querySelectorAll('.embla__dot'))
                dotNodes.forEach((dotNode, index) => {
                    dotNode.addEventListener('click', () => scrollTo(index), false)
                })
            }

            const toggleDotBtnsActive = () => {
                const previous = emblaApi.previousScrollSnap()
                const selected = emblaApi.selectedScrollSnap()
                dotNodes[previous].classList.remove('embla__dot--selected')
                dotNodes[selected].classList.add('embla__dot--selected')
            }

            emblaApi
                .on('init', addDotBtnsWithClickHandlers)
                .on('reInit', addDotBtnsWithClickHandlers)
                .on('init', toggleDotBtnsActive)
                .on('reInit', toggleDotBtnsActive)
                .on('select', toggleDotBtnsActive)

            return () => {
                dotsNode.innerHTML = ''
            }
        }

        const dotsNode = document.querySelector('.slider1 .embla__dots')
        const emblaNode = document.querySelector('.slider1')
        const options = {  align: 'start', loop: true }
        const plugins = [EmblaCarouselAutoplay({delay: 4000, stopOnInteraction:false})]
        const emblaApi = EmblaCarousel(emblaNode, options, plugins)

        const removeDotBtnsAndClickHandlers = addDotBtnsAndClickHandlers(
            emblaApi,
            dotsNode
        )
        emblaApi.on('destroy', removeDotBtnsAndClickHandlers)
    </script>

</body>
</html>
	

