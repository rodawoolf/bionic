-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 16 2016 г., 12:21
-- Версия сервера: 10.1.14-MariaDB
-- Версия PHP: 7.0.10RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bionic_roda`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advs`
--

CREATE TABLE `advs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `price` float DEFAULT NULL,
  `img_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `advs`
--

INSERT INTO `advs` (`id`, `user_id`, `title`, `content`, `price`, `img_id`) VALUES
(1, 1, 'Куплю', 'машину', 1, 0),
(2, 1, 'Продам', 'Будинок на березы океану', 2, 0),
(3, 3, 'Щось куплю', 'Скуповую старі речі', 120, 0),
(4, 4, 'Продам', 'Продається магазин', 0, 0),
(5, 1, 'Продам', 'Будинок на березы океану', 2, NULL),
(6, 1, 'Продам', 'Будинок на березы океану', 2, NULL),
(7, 1, 'Продам', 'Будинок на березы океану', 2, NULL),
(8, 1, 'Продам', 'Будинок на березы океану', 2, NULL),
(9, 1, 'Продам', 'Будинок на березы океану', 2, NULL),
(10, 1, 'Продам', 'Будинок на березы океану', 2, NULL),
(11, 1, 'Куплю', 'машину', 1, NULL),
(12, 1, 'Куплю', 'машину', 1, NULL),
(13, 4, 'Продам', 'Продається магазин', 0, NULL),
(14, 4, 'Продам', 'Продається магазин', 0, NULL),
(17, 1, 'Куплю', 'машину', 1, 3),
(18, 1, 'Продам', 'Будинок на березы океану', 2, 4),
(19, 1, 'Куплю', 'машину', 1, 5),
(20, 1, 'Куплю', 'машину', 1, 6),
(21, 1, 'Куплю', 'машину', 1, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `adv_id` int(11) DEFAULT NULL,
  `text` varchar(500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `adv_id`, `text`) VALUES
(1, 1, 1, 'some text'),
(2, 0, 0, 'Интересно'),
(3, 0, 0, 'Интересно'),
(4, 0, 0, 'some text2');

-- --------------------------------------------------------

--
-- Структура таблицы `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `fullName` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET cp1251 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `img`
--

INSERT INTO `img` (`id`, `name`, `fullName`, `size`, `type`) VALUES
(4, 'Тим билдинг ИТ отдел ИМК.xlsx', 'C:\\Apache24\\htdocs\\app\\src\\Roda\\Services1471335582Тим билдинг ИТ отдел ИМК.xlsx', 14827, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
(5, 'Тим билдинг ИТ отдел ИМК.xlsx', 'C:/Apache24/htdocs/app/Storage/1471335846Тим билдинг ИТ отдел ИМК.xlsx', 14827, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
(6, 'Тим билдинг ИТ отдел ИМК.xlsx', 'C:/Apache24/htdocs/app/Storage/1471342646Тим билдинг ИТ отдел ИМК.xlsx', 14779, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
(7, 'Тим билдинг ИТ отдел ИМК.xlsx', 'C:/Apache24/htdocs/app/Storage/1471349557Тим билдинг ИТ отдел ИМК.xlsx', 14837, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(40) CHARACTER SET utf8 NOT NULL,
  `middlename` varchar(40) CHARACTER SET utf8 NOT NULL,
  `nic` varchar(40) CHARACTER SET utf8 NOT NULL,
  `email` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `passwd` varchar(255) CHARACTER SET cp1251 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `middlename`, `nic`, `email`, `passwd`) VALUES
(1, 'sdfgs', 'sdfsdf', '', 'sdgas', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, 'Nino', 'Prada', 'Dee', 'NPD', '', ''),
(4, 'Veronika', 'Shepel', 'Lora', 'hajdamaka', '', '87f53648e76a1b5c09ad6072d5713389'),
(5, 'Николай', 'Примак', 'Васильевич', 'Nicola', 'Nicola@gf.ua', ''),
(7, 'Igor', 'Frank', 'Serg', 'Credo', 'grom@gfasad.com', ''),
(8, 'Corsa', 'Grednjuk', '', 'coco', 'gred_2001@mail.ru', 'd41d8cd98f00b204e9800998ecf8427e'),
(18, 'Veronika', 'Shepel', 'Lora', 'hajdamaka', 'dd', ''),
(19, 'Veronika', 'Shepel', 'Lora', 'hajdamakad', 'dd', ''),
(20, 'fr', 'rf', '', 'fr', 'gred_2001@mail.ru', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advs`
--
ALTER TABLE `advs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advs`
--
ALTER TABLE `advs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
