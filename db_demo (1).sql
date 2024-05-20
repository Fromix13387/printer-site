-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 20 2024 г., 07:29
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_demo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Лазерный принтер'),
(2, 'Струйный принтер'),
(3, 'Термопринтер'),
(4, '5656');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Япония'),
(2, 'Швеция'),
(3, 'Италия'),
(4, 'Голландия'),
(5, 'Россия'),
(6, 'Колечия'),
(7, 'СССР'),
(8, 'Германия');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `user_id`, `count`, `status`, `created_at`) VALUES
(23, 3, 7, 9, 'Новый', '2024-05-19 23:54:31'),
(24, 4, 7, 9, 'Новый', '2024-05-19 23:54:31'),
(25, 3, 7, 8, 'Новый', '2024-05-20 00:20:01'),
(26, 4, 7, 6, 'Новый', '2024-05-20 00:20:01'),
(27, 3, 7, 3, 'Новый', '2024-05-20 00:23:02'),
(28, 13, 7, 3, 'Отменён', '2024-05-20 00:23:02'),
(29, 3, 7, 1, 'принят', '2024-05-20 00:23:55'),
(30, 3, 7, 1, 'Принят', '2024-05-20 00:24:30'),
(31, 5, 7, 4, 'отменён', '2024-05-20 01:23:11');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `model` varchar(256) NOT NULL,
  `id_category` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `path` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `id_country`, `year`, `model`, `id_category`, `count`, `path`, `created_at`) VALUES
(3, 'Необычный принтер', 4000, 1, 2022, 'Необычный', 3, 45, '2.png', '2022-02-16 06:58:58'),
(4, 'Уникальный принтер', 500, 6, 2022, 'Обычный', 1, 58, 'hp.png', '2022-02-16 06:58:58'),
(5, 'Принтер принтер', 532, 7, 2021, 'Необычный', 2, 54, 'img1.jpg', '2022-02-16 06:58:58'),
(6, 'Квалиф принтер', 40643, 2, 2021, 'Обычный', 1, 11, 'img4.jpg', '2022-02-16 06:58:58'),
(7, 'Рубцовый принтер', 41210, 8, 2021, 'Необычный', 1, 647, 'img7.jpg', '2022-02-16 06:58:58'),
(8, 'Словесный принтер', 110, 8, 2020, 'Обычный', 3, 55, 'img8.jpg', '2022-02-16 06:58:58'),
(9, 'Первый принтер', 5320, 4, 2020, 'Необычный', 2, 4, 'img10.jpg', '2022-02-16 06:58:58'),
(10, 'Второй принтер', 564, 6, 2020, 'Обычный', 2, 32, 'img12.jpg', '2022-02-16 06:58:58'),
(11, 'Десятый принтер', 927, 1, 2019, 'Необычный', 1, 1, 'img13.jpg', '2022-02-16 06:58:58'),
(12, 'Кашерный принтер', 624, 7, 2019, 'Обычный', 3, 87, 'img14.png', '2022-02-16 06:58:58'),
(13, 'Деформированный принтер', 912, 2, 2019, 'Необычный', 1, 24, 'img15.png', '2022-02-16 06:58:58'),
(14, 'Пригодный принтер', 9673, 8, 2018, 'Обычный', 3, 32, 'img17.png', '2022-02-16 06:58:58'),
(15, 'Принтер принтеров', 5715, 1, 2018, 'Необычный', 1, 95, 'img18.png', '2022-02-16 06:58:58'),
(16, 'Да принтер', 4324, 1, 2018, 'Обычный', 3, 117, 'img6.jpg', '2022-02-16 06:58:58'),
(17, 'Нет принтер', 1321, 6, 2017, 'Необычный', 1, 7, 'canon.png', '2022-02-16 06:58:58'),
(18, 'Выбор принтер', 551, 3, 2017, 'Обычный', 3, 2, 'kyocera.png', '2022-02-16 06:58:58'),
(19, 'Ключ принтер', 2135, 8, 2017, 'Необычный', 2, 3, 'tsc.png', '2022-02-16 06:58:58'),
(20, 'Умозаключение принтер', 6463, 1, 2016, 'Обычный', 1, 4, 'tsc-alpha.png', '2022-02-16 06:58:58'),
(21, 'Обычный обычный', 431, 1, 2016, 'Необычный', 1, 5, 'img7.jpg', '2022-02-16 06:58:58'),
(22, 'Five Game', 123, 4, 1991, 'fjjfjf', 1, 3332, 'img16.png', '2023-06-05 15:39:08');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `value`, `id_user`, `id_product`, `date`) VALUES
(4, 'Принтер так себе', 7, 4, '2024-05-17 08:59:23');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'пользователь'),
(2, 'администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `surname` varchar(256) NOT NULL,
  `patronymic` varchar(256) DEFAULT NULL,
  `login` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `id_role`) VALUES
(5, 'пользователь', 'Норм имя2', 'Нет его', 'qweqw', 'qw111e@mail.ru', '$2y$10$DOuX/EdqRTP9rK.4l3dzCOVbdAI0ylQK0I408xHTTjvS240LBcCxi', 1),
(6, 'Саша11', 'Васильев', 'Куку', 'qwe2', 'qweqwe1@mail.ru', '$2y$10$c9bs1ZY5Cj8pfXqk2I7woOncssD6VxiItUB5G8SFxvPeUcdGjQwpK', 1),
(7, 'Вася', 'Пупкин', 'Васильевич', 'Fromix', 'qwe@mail.ru', '$2y$10$jBLNvPhQtcukDcOh5jUGHeXvWILLfCHxAYfdwjOIROHd2KW4b1efy', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `jwt_user` (`user_id`),
  ADD KEY `jwt_product` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `jwt_country` (`id_country`),
  ADD KEY `jwt_caterogies` (`id_category`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_jwt` (`id_user`),
  ADD KEY `product_jwt` (`id_product`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `jwt_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `jwt_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jwt_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `jwt_caterogies` FOREIGN KEY (`id_category`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jwt_country` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `product_jwt` FOREIGN KEY (`id_product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_jwt` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `jwt_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
