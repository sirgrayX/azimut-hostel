-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 20 2022 г., 10:02
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hostel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `adminname` varchar(40) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admin`, `adminname`, `password`) VALUES
(1, '$udo$ergey', '$2y$10$iycka623L4fEmtyUfUmljOxI8OkGHIdlIaz1kua80A1GQXXwcaqDW');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id_category` int NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_category`, `category`) VALUES
(1, 'Стандарт'),
(2, 'Эконом'),
(3, 'Люкс');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int NOT NULL,
  `name` varchar(60) NOT NULL,
  `category_id` int NOT NULL,
  `room_count` int NOT NULL,
  `description` text NOT NULL,
  `status_id` int NOT NULL,
  `price` int NOT NULL,
  `photo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id_room`, `name`, `category_id`, `room_count`, `description`, `status_id`, `price`, `photo`) VALUES
(2, 'Студия однокомнатная двуместная', 1, 1, 'Просторный номер с двумя раздельными или одной двуспальной кроватью, оснащенный диваном и креслами, рабочим столом. Также в номере имеется телевизор, телефон и холодильник, кондиционер. На диване возможно разместить третьего гостя. В номере предоставляется бесплатный Интернет Wi-Fi.', 1, 3200, 'images/rooms/studio-1r-2p.jpg'),
(3, 'Эконом двухкомнатный', 2, 2, 'Просторный номер, состоящий из 2-х комнат - спальни и гостиной. Спальня оснащена двумя раздельными либо одной большой кроватью с прикроватными тумбочками. В гостиной возможно размещение третьего человека на дополнительной кровати.', 1, 3150, 'images/rooms/econom-2r.jpg'),
(4, 'Люкс однокомнатный одноместный', 3, 1, 'Одноместный номер, оборудованный полутороспальной кроватью. В номере имеется - рабочий стол, стул, телевизор, телефон, холодильник, кондиционер, полный санузел с комплектом полотенец, косметическими принадлежностями и феном.\r\nВ номере предоставляется бесплатный Интернет Wi-Fi.', 1, 2400, 'images/rooms/luxe-1r-1p.jpg'),
(5, 'Люкс двухкомнатный двуместный', 3, 2, '2-комнатный двухместный номер с современной мебелью - двумя раздельными или одной двуспальной кроватью, рабочим столом и стульями. Также оснащен необходимой техникой - телевизор ЖК(LCD), холодильник, телефон, кондиционер. В номере - полный санузел с комплектом полотенец, косметическими принадлежностями и феном.\r\nБесплатный Интернет Wi-Fi.', 1, 2700, 'images/rooms/luxe-2r-2p.jpg'),
(6, 'Стандарт однокомнатный двуместный', 1, 1, '1-комнатный двухместный номер с современной мебелью - двумя раздельными либо одной большой кроватью, рабочим столом и стульями. Также оснащен необходимой техникой - телевизор ЖК(LCD), холодильник, телефон. В номере - полный санузел с комплектом полотенец и косметическими принадлежностями.\r\nПредоставляется бесплатный Интернет Wi-Fi.', 1, 2300, 'images/rooms/standard-1r-2p.jpg'),
(7, 'Стандарт двухкомнатный', 1, 2, 'Номер состоит из 2 комнат: спальни с двумя раздельными либо одной большой кроватью и гостиной, оснащенной диваном и креслами, рабочим столом. Также в номере имеется телевизор, телефон и холодильник. На диване возможно разместить третьего гостя.\r\nВ номере предоставляется бесплатный Интернет Wi-Fi.', 1, 3100, 'images/rooms/standard-2r.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id_status` int NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'свободен'),
(2, 'забронирован'),
(3, 'занят');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `room_id` int NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `cost` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `user_id`, `room_id`, `checkin`, `checkout`, `cost`) VALUES
(1, 3, 3, '2022-03-11', '2022-03-13', 6300),
(2, 11, 5, '2022-03-15', '2022-03-20', 13500),
(3, 11, 5, '2022-03-04', '2022-03-08', 10800),
(6, 11, 5, '2022-03-31', '2022-04-03', 8100),
(9, 3, 4, '2022-03-23', '2022-03-26', 7200),
(10, 12, 5, '2022-03-16', '2022-03-20', 10800);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_surname` varchar(40) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `user_surname`, `user_email`, `password`, `created`) VALUES
(3, 'Сергей', 'Булганин', 's.bulganin@bk.ru', '$2y$10$yfxYiJNEM8iKyU10qSN18OrK/1aCNktUb8fvsM07.Ow8H0pyh7XFy', '2022-03-13'),
(9, 'Александр', 'Чумаков', 'a.chumakov@mail.ru', '$2y$10$4HF.W6tVcGzJYzqQ0lia7.jNaMordWCuuccLtpsWtRFbUGVj/V4Qq', '2022-03-13'),
(10, 'Алина', 'Спицына', 'kisaa@mail.ru', '$2y$10$wVPRG1lYex7ImiiY79a18.lc8cj0FoRATBALKY3mBdzYG9bVQYBha', '2022-03-13'),
(11, 'Ирина', 'Чумакова', 'irina_chum@bk.ru', '$2y$10$DpelNAaBdm24pzHvlCE1qOzXTpCl1Gxnt5rXe9hDQPk9PIz9EtGn2', '2022-03-15'),
(12, 'Сергей', 'Булганин', 'sergey_bulganin@bk.ru', '$2y$10$AZf8q6rx9Ne6Sii7ISDkg.fEiQTkb.DN6B6HCCVOmfC66zK3mtWn.', '2022-03-16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_room_2` (`id_room`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id_room`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
