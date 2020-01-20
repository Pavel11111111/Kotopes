-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 21 2019 г., 17:05
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kotpes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `animals`
--

CREATE TABLE `animals` (
  `id` int(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `countlikes` int(100) NOT NULL DEFAULT 0,
  `dateinsert` date DEFAULT NULL,
  `userid` int(255) UNSIGNED NOT NULL,
  `checkrecord` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `animals`
--

INSERT INTO `animals` (`id`, `img`, `name`, `countlikes`, `dateinsert`, `userid`, `checkrecord`) VALUES
(25, 'QvX0qFvADuQy2z2f8bgaPqZ2-whDxCKs.jpg', 'Pavel', 0, '2019-09-11', 121, 1),
(27, 'HDmoJzxVfQfLYpoWJqrJjQ-ZKdzQdJxI.jpg', 'Пёсель рандомный2', 1, '2019-09-30', 121, 1),
(33, 'yFaNtZ7vigPpBamh_z_iSeRkx39v_w5G.png', 'шагойка', 0, '2019-10-27', 148, 1),
(34, 'aTu8-w5ctWA7Z8hOa1Wv0vkj9bj6IXtF.png', 'аааа', 0, '2019-11-18', 148, 1),
(35, 'vBP8JemQMqNPXhvbMSt1nFs9JYTJnaIo.jpg', 'ясыфс', 0, '2019-11-18', 148, 1),
(36, '5Bx1ToXY3zI1gX5n55r6-g7-FzlSCwt9.png', 'пкеронеконео', 0, '2019-11-18', 148, 1),
(37, 'I7WH04OR8VD85CBLAqQjc9NNleqgs4vM.png', 'иапкат', 0, '2019-11-18', 148, 1),
(38, 'uV0ijH_QvoBCOTHYgJKRQpa_yqCS2Ntn.jpg', 'ацуыпркегке', 0, '2019-11-18', 148, 1),
(39, '4ews7vneOLMlFe8eZqQ2vMN-CAh-3bd-.png', 'm,k', 0, '2019-11-18', 148, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '148', 1571658964),
('banned', '149', 1573210255);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1571658964, 1571658964),
('banned', 1, NULL, NULL, NULL, 1571906863, 1571906863),
('viewAdminPage', 2, 'Просмотр админки', NULL, NULL, 1571658964, 1571658964);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'viewAdminPage');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(100) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` datetime(6) NOT NULL,
  `headline` varchar(50) NOT NULL,
  `recommend` int(1) NOT NULL,
  `text` varchar(500) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filtername`
--

CREATE TABLE `filtername` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `typeproductid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filtername`
--

INSERT INTO `filtername` (`id`, `name`, `typeproductid`) VALUES
(24, '', 39),
(25, 'Марка', 39),
(26, 'Тип корма', 39),
(27, 'Возраст', 39);

-- --------------------------------------------------------

--
-- Структура таблицы `filterparam`
--

CREATE TABLE `filterparam` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `filternameid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filterparam`
--

INSERT INTO `filterparam` (`id`, `name`, `filternameid`) VALUES
(39, 'PP', 25),
(40, 'апрен', 24),
(41, 'Royal Canin', 25),
(42, 'Щенки', 27);

-- --------------------------------------------------------

--
-- Структура таблицы `filterproduct1`
--

CREATE TABLE `filterproduct1` (
  `filterproduct1id` int(100) NOT NULL,
  `productid` int(11) NOT NULL,
  `typeanimalsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filterproduct1`
--

INSERT INTO `filterproduct1` (`filterproduct1id`, `productid`, `typeanimalsid`) VALUES
(14, 33, 26),
(18, 36, 26),
(20, 38, 26),
(22, 39, 26),
(26, 39, 26),
(28, 39, 28),
(31, 40, 26),
(32, 26, 26);

-- --------------------------------------------------------

--
-- Структура таблицы `filterproduct2`
--

CREATE TABLE `filterproduct2` (
  `filterproduct2id` int(100) NOT NULL,
  `productid` int(100) NOT NULL,
  `typeproductid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filterproduct2`
--

INSERT INTO `filterproduct2` (`filterproduct2id`, `productid`, `typeproductid`) VALUES
(9, 33, 39),
(12, 36, 39),
(13, 38, 39),
(14, 39, 39),
(15, 39, 39),
(16, 40, 39),
(17, 26, 39);

-- --------------------------------------------------------

--
-- Структура таблицы `filterproduct3`
--

CREATE TABLE `filterproduct3` (
  `filterproduct3id` int(100) NOT NULL,
  `productid` int(100) NOT NULL,
  `filterparamid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filterproduct3`
--

INSERT INTO `filterproduct3` (`filterproduct3id`, `productid`, `filterparamid`) VALUES
(7, 33, 40),
(8, 33, 39),
(11, 36, 40),
(12, 39, 40),
(13, 39, 39),
(14, 39, 40),
(15, 40, 41),
(17, 26, 40),
(21, 40, 42);

-- --------------------------------------------------------

--
-- Структура таблицы `hots`
--

CREATE TABLE `hots` (
  `id` int(100) NOT NULL,
  `img` varchar(50) NOT NULL,
  `gltext` varchar(50) NOT NULL,
  `text` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hots`
--

INSERT INTO `hots` (`id`, `img`, `gltext`, `text`, `url`) VALUES
(1, 'optimize.webp', 'Purina One', 'Только сегодня, скидка составляет 10%c', 'https://yandex.ru/divand'),
(2, 'royal-canin-logo.jpg', 'Побалуйте своего любимца', 'Royal canin на 100% натурален', 'https://yandex.ru/'),
(4, 'GO-Campaign.png', 'GO!', 'Попробуйте новую линейку кормов от известного производителя', 'https://yandex.ru/');

-- --------------------------------------------------------

--
-- Структура таблицы `inform_user`
--

CREATE TABLE `inform_user` (
  `id` int(255) NOT NULL,
  `variation_id` int(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `inform_user`
--

INSERT INTO `inform_user` (`id`, `variation_id`, `email`) VALUES
(3, 22, 'pahan_cherep@mail.ru'),
(4, 22, 'cherepos@yandex.ru'),
(6, 21, 'pahan_cherep@mail.ru'),
(7, 21, 'ceriysom@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `animals_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `animals_id`) VALUES
(5, 121, 3),
(6, 121, 4),
(18, 121, 1),
(20, 121, 2),
(21, 121, 13),
(23, 123, 2),
(24, 123, 3),
(26, 123, 4),
(29, 123, 5),
(30, 123, 6),
(35, 121, 26),
(37, 124, 27),
(38, 125, 5),
(39, 138, 20),
(40, 139, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1571657539),
('m140506_102106_rbac_init', 1571657549),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1571657549),
('m180523_151638_rbac_updates_indexes_without_prefix', 1571657549);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `name` varchar(200) NOT NULL,
  `countbuy` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `description`, `name`, `countbuy`) VALUES
(26, '<b>Уходерка Hello Pet</b> имеет надежную металлическую основу, поэтому идеально подходит для вычесывания очень густой или жесткой шерсти.<br><br> Частая металлическая щетина ффективно удаляет старую шерсть и подшерсток, стимулирует волосяные луковицы и придает шерсти здоровый, ухоженный вид.<br><br> Пуходерка Hello Pet имеет удобную прорезиненную ручку с упором на большой палец. Длина: 14 см. Размер корда: 3,5 см*8,5 см. Длина зубьев: 1,5 см', 'Пуходерка Hello Pet 16811M металлическая f f f f f f f f f  f fff f f f f f f  ff f f  ff f f f f f f f f f f f f f ', 0),
(33, '<b>PRO PLAN® NUTRISAVOUR® DELICATE</b> для взрослых кошек с чувствительным пищеварением, с океанической рыбой в соусе еее', 'про план так себе', 4),
(36, '22276', 'вкусный кормяра', 0),
(37, 'wfw', 'fwf', 0),
(38, 'efw', 'ewfwe', 0),
(39, '1234', '123', 0),
(40, 'ДОРОГОЙ КООРМ НО ВРОДЕ НИЧЕ ДАЖЕК ЕСЛИ НЕ ХЧЕТСЯ НО ВООБЩЕ КАК ЕГО ОНИ КАЖДДЫЙ ДЕНЬ ВСЮ ЖИЗНЬ ЕДЯТ ЧЁ ВООБЩЕ НИЧЕГО ДРУГОЕ НЕ ИНТЕРЕСНО', 'Royal Canin ', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `typeanimals`
--

CREATE TABLE `typeanimals` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `typeanimals`
--

INSERT INTO `typeanimals` (`id`, `name`) VALUES
(28, 'Грызуны'),
(26, 'Кошки');

-- --------------------------------------------------------

--
-- Структура таблицы `typeproduct`
--

CREATE TABLE `typeproduct` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `typeanimalsname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `typeproduct`
--

INSERT INTO `typeproduct` (`id`, `name`, `typeanimalsname`) VALUES
(39, 'Корм', 'Кошки'),
(40, 'Ебаная хуйня', 'Кошки');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `validate` varchar(100) NOT NULL,
  `recover` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `password`, `name`, `patronymic`, `date`, `email`, `number`, `validate`, `recover`) VALUES
(125, '$2y$13$aaHEjXzCCD2CSPqEcDMHcefrTlP1nnEN4yXWlmwsJPulvjZGN0cpe', 'Платон', 'Мозгов', '2001-01-01', 'ceriysom@gmail.com', '89998877777', '1', NULL),
(141, '$2y$13$xY9yKoW/kmqh.DJJjP8KcuqaRGuQbmN03zkhnitfsHhCnTGbRiWia', 'Павел', 'Черепанов', '1998-01-24', 'pahan_cherep@mail.ru', '89128376864', '66', NULL),
(148, '$2y$13$.EpEPkmpFOQTEJEXXDv.WOHI4VDFHfZE8MwDMsjd998SY4F92vRXa', 'Администратор', 'Администратор', '2019-10-21', 'admin', '89999999999', '1', NULL),
(149, '$2y$13$xr4sHesTxDqnZkWbhk4OCuOfbe3pQzZDvF5fVfiZ1xXasjxKy5wly', 'СергО', 'СОмОв', '1991-01-01', 'cherepos@yandex.ru', '89194252348', '1', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `variation`
--

CREATE TABLE `variation` (
  `id` int(100) NOT NULL,
  `productid` int(100) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `discount` int(50) DEFAULT NULL,
  `count` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `variation`
--

INSERT INTO `variation` (`id`, `productid`, `img`, `name`, `price`, `discount`, `count`) VALUES
(21, 26, 'heart3.png', '100г.', 200, NULL, 0),
(22, 26, NULL, '200г.', 300, NULL, 4),
(23, 26, 'OtMYvZ0oMFQ.jpg', '300г.', 20, NULL, 278),
(25, 33, 'Pro-Plan-Cat-Original-Adult-OptiRenal-Chicken-1.5kg-43857692-360x360px-Front_7.jpg', '400г', 30, NULL, 3),
(26, 33, NULL, '1,2кг', 1500, NULL, 2),
(27, 33, NULL, '10кг', 12000, NULL, 77),
(29, 36, 'X_tm3cArsEg.jpg', '12раз', 226, 2, 888),
(30, 40, 'mtm-golf-vi-gtd-09.jpg', '400г', 500, NULL, 7),
(31, 40, NULL, '1,5кг', 2, NULL, 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filtername`
--
ALTER TABLE `filtername`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeproductid` (`typeproductid`);

--
-- Индексы таблицы `filterparam`
--
ALTER TABLE `filterparam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filternameid` (`filternameid`);

--
-- Индексы таблицы `filterproduct1`
--
ALTER TABLE `filterproduct1`
  ADD PRIMARY KEY (`filterproduct1id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `typeanimalsid` (`typeanimalsid`);

--
-- Индексы таблицы `filterproduct2`
--
ALTER TABLE `filterproduct2`
  ADD PRIMARY KEY (`filterproduct2id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `typeproductid` (`typeproductid`);

--
-- Индексы таблицы `filterproduct3`
--
ALTER TABLE `filterproduct3`
  ADD PRIMARY KEY (`filterproduct3id`),
  ADD KEY `filterparamid` (`filterparamid`),
  ADD KEY `productid` (`productid`);

--
-- Индексы таблицы `hots`
--
ALTER TABLE `hots`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `inform_user`
--
ALTER TABLE `inform_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `typeanimals`
--
ALTER TABLE `typeanimals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeanimals_ibfk_1` (`name`);

--
-- Индексы таблицы `typeproduct`
--
ALTER TABLE `typeproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeanimalsname` (`typeanimalsname`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `filtername`
--
ALTER TABLE `filtername`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `filterparam`
--
ALTER TABLE `filterparam`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `filterproduct1`
--
ALTER TABLE `filterproduct1`
  MODIFY `filterproduct1id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `filterproduct2`
--
ALTER TABLE `filterproduct2`
  MODIFY `filterproduct2id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `filterproduct3`
--
ALTER TABLE `filterproduct3`
  MODIFY `filterproduct3id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `hots`
--
ALTER TABLE `hots`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `inform_user`
--
ALTER TABLE `inform_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `typeanimals`
--
ALTER TABLE `typeanimals`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `typeproduct`
--
ALTER TABLE `typeproduct`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT для таблицы `variation`
--
ALTER TABLE `variation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filtername`
--
ALTER TABLE `filtername`
  ADD CONSTRAINT `filtername_ibfk_1` FOREIGN KEY (`typeproductid`) REFERENCES `typeproduct` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filterparam`
--
ALTER TABLE `filterparam`
  ADD CONSTRAINT `filterparam_ibfk_1` FOREIGN KEY (`filternameid`) REFERENCES `filtername` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filterproduct1`
--
ALTER TABLE `filterproduct1`
  ADD CONSTRAINT `filterproduct1_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `filterproduct1_ibfk_2` FOREIGN KEY (`typeanimalsid`) REFERENCES `typeanimals` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filterproduct2`
--
ALTER TABLE `filterproduct2`
  ADD CONSTRAINT `filterproduct2_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `filterproduct2_ibfk_2` FOREIGN KEY (`typeproductid`) REFERENCES `typeproduct` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `filterproduct3`
--
ALTER TABLE `filterproduct3`
  ADD CONSTRAINT `filterproduct3_ibfk_1` FOREIGN KEY (`filterparamid`) REFERENCES `filterparam` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `filterproduct3_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `inform_user`
--
ALTER TABLE `inform_user`
  ADD CONSTRAINT `inform_user_ibfk_2` FOREIGN KEY (`variation_id`) REFERENCES `variation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `typeproduct`
--
ALTER TABLE `typeproduct`
  ADD CONSTRAINT `typeproduct_ibfk_1` FOREIGN KEY (`typeanimalsname`) REFERENCES `typeanimals` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `variation`
--
ALTER TABLE `variation`
  ADD CONSTRAINT `variation_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
