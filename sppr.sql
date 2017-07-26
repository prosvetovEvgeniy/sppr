-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 26 2017 г., 09:50
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sppr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `criterions`
--

CREATE TABLE IF NOT EXISTS `criterions` (
  `id` int(11) NOT NULL,
  `criterionName` varchar(255) NOT NULL,
  `experiment_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `criterions`
--

INSERT INTO `criterions` (`id`, `criterionName`, `experiment_id`) VALUES
(59, 'Скорость', 56),
(60, 'Цена', 56),
(61, 'Престиж', 56),
(119, 'Дождливое лето', 84),
(120, 'Жаркое лето', 84),
(121, 'Умеренное', 84),
(122, 'Крит1', 85),
(123, 'Крит2', 85),
(124, 'Крит3', 85),
(165, 'Повышение стоимости бизнеса', 99),
(166, 'Финансовая гибкость', 99),
(167, 'Стоимость источников ', 99),
(168, 'Финансовая устойчивость ', 99),
(176, 'Зарплата', 103),
(177, 'Удаленность', 103),
(178, 'Условия труда', 103),
(179, 'Социальный пакет', 103),
(180, 'График работы', 103);

-- --------------------------------------------------------

--
-- Структура таблицы `experiments`
--

CREATE TABLE IF NOT EXISTS `experiments` (
  `id` int(11) NOT NULL,
  `experimentName` varchar(255) DEFAULT NULL,
  `method_id` int(4) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `experiments`
--

INSERT INTO `experiments` (`id`, `experimentName`, `method_id`, `user_id`) VALUES
(56, 'Выбор лучшего автомобиля', 1, 12),
(84, 'Выбор типа выпускаемой продукции', 3, 12),
(85, 'Выбор магистратуры', 1, 17),
(99, 'Структура капитала', 1, 12),
(103, 'Поиск работы', 1, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `methods`
--

CREATE TABLE IF NOT EXISTS `methods` (
  `id` int(4) NOT NULL,
  `methodName` varchar(150) NOT NULL,
  `abbreviation` varchar(150) NOT NULL,
  `filter_ref` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `methods`
--

INSERT INTO `methods` (`id`, `methodName`, `abbreviation`, `filter_ref`, `image`) VALUES
(1, 'Метод анализа иерархий', 'МАИ', 'mah', 'design/img/help/mah/mah2.png'),
(2, 'Принятие решений в условиях неопределенности', 'Остальное', 'matrix_method', 'design/img/help/matrixMethod/matr1.png'),
(3, 'Принятие решений в условиях риска', 'Остальное', 'risk_method', 'design/img/help/riskMethod/risk1.png');

-- --------------------------------------------------------

--
-- Структура таблицы `probabilities`
--

CREATE TABLE IF NOT EXISTS `probabilities` (
  `experiment_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `probabilities`
--

INSERT INTO `probabilities` (`experiment_id`, `criterion_id`, `value`) VALUES
(84, 119, 0.2),
(84, 120, 0.5),
(84, 121, 0.3);

-- --------------------------------------------------------

--
-- Структура таблицы `result_mah`
--

CREATE TABLE IF NOT EXISTS `result_mah` (
  `experiment_id` int(11) NOT NULL,
  `alternative_name` varchar(255) NOT NULL,
  `weight_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `result_mah`
--

INSERT INTO `result_mah` (`experiment_id`, `alternative_name`, `weight_value`) VALUES
(56, 'Жигули', 0.147),
(56, 'Ауди', 0.286),
(56, 'Феррари', 0.567),
(85, 'Алт1', 0.294),
(85, 'Алт2', 0.404),
(85, 'Алт3', 0.302),
(99, 'Акции', 0.4),
(99, 'Нераспределенная прибыль', 0.216),
(99, 'Банковские кредиты ', 0.256),
(99, 'Облигационные займы', 0.128),
(103, 'Dr.Web', 0.335),
(103, 'Касперский', 0.255),
(103, '2Gis', 0.21),
(103, 'КрасМАШ', 0.1),
(103, 'СибГУ', 0.101);

-- --------------------------------------------------------

--
-- Структура таблицы `result_matrix_method`
--

CREATE TABLE IF NOT EXISTS `result_matrix_method` (
  `experiment_id` int(11) NOT NULL,
  `criterion_name` varchar(255) NOT NULL,
  `alternative_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `result_risk_method`
--

CREATE TABLE IF NOT EXISTS `result_risk_method` (
  `experiment_id` int(11) NOT NULL,
  `alternative_name` varchar(255) NOT NULL,
  `identifier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `result_risk_method`
--

INSERT INTO `result_risk_method` (`experiment_id`, `alternative_name`, `identifier`) VALUES
(84, 'Шляпы', 'высокий риск'),
(84, 'Зонты', 'высокий риск'),
(84, 'Плащи', 'высокий риск'),
(84, 'Плащи', 'средний риск'),
(84, 'Шляпы', 'средний риск'),
(84, 'Зонты', 'средний риск'),
(84, 'Плащи', 'низкий риск'),
(84, 'Зонты', 'низкий риск'),
(84, 'Шляпы', 'низкий риск');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(12, 'admin', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'admin@mail.ru'),
(17, 'evgeniy', '8cb2237d0679ca88db6464eac60da96345513964', 'evgeniy@mail.ru'),
(18, 'artem', '72af86cee4ff35302573129164a1421abab941ad', 'artem@mail.ru'),
(20, 'saha', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'saha@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `utility_matrix`
--

CREATE TABLE IF NOT EXISTS `utility_matrix` (
  `experiment_id` int(11) NOT NULL,
  `alternative_i_id` int(11) NOT NULL,
  `criterion_j_id` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `utility_matrix`
--

INSERT INTO `utility_matrix` (`experiment_id`, `alternative_i_id`, `criterion_j_id`, `value`) VALUES
(84, 118, 119, 80),
(84, 118, 120, 60),
(84, 118, 121, 40),
(84, 119, 119, 70),
(84, 119, 120, 40),
(84, 119, 121, 80),
(84, 120, 119, 70),
(84, 120, 120, 50),
(84, 120, 121, 60),
(84, 121, 119, 50),
(84, 121, 120, 50),
(84, 121, 121, 70),
(84, 122, 119, 75),
(84, 122, 120, 50),
(84, 122, 121, 50),
(84, 123, 119, 35),
(84, 123, 120, 75),
(84, 123, 121, 60);

-- --------------------------------------------------------

--
-- Структура таблицы `аlternatives`
--

CREATE TABLE IF NOT EXISTS `аlternatives` (
  `id` int(11) NOT NULL,
  `аlternativeName` varchar(255) NOT NULL,
  `experiment_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `аlternatives`
--

INSERT INTO `аlternatives` (`id`, `аlternativeName`, `experiment_id`) VALUES
(54, 'Жигули', 56),
(55, 'Ауди', 56),
(56, 'Феррари', 56),
(118, 'Зонты', 84),
(119, 'Куртки', 84),
(120, 'Плащи', 84),
(121, 'Сумки', 84),
(122, 'Туфли', 84),
(123, 'Шляпы', 84),
(124, 'Алт1', 85),
(125, 'Алт2', 85),
(126, 'Алт3', 85),
(169, 'Акции', 99),
(170, 'Нераспределенная прибыль', 99),
(171, 'Банковские кредиты ', 99),
(172, 'Облигационные займы', 99),
(180, 'Dr.Web', 103),
(181, 'Касперский', 103),
(182, '2Gis', 103),
(183, 'КрасМАШ', 103),
(184, 'СибГУ', 103);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `criterions`
--
ALTER TABLE `criterions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiment_id` (`experiment_id`);

--
-- Индексы таблицы `experiments`
--
ALTER TABLE `experiments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `method_id` (`method_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `methods`
--
ALTER TABLE `methods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `probabilities`
--
ALTER TABLE `probabilities`
  ADD KEY `experiment_id` (`experiment_id`),
  ADD KEY `criterion_id` (`criterion_id`);

--
-- Индексы таблицы `result_mah`
--
ALTER TABLE `result_mah`
  ADD KEY `experiment_id` (`experiment_id`),
  ADD KEY `experiment_id_2` (`experiment_id`);

--
-- Индексы таблицы `result_matrix_method`
--
ALTER TABLE `result_matrix_method`
  ADD KEY `experiment_id` (`experiment_id`),
  ADD KEY `experiment_id_2` (`experiment_id`);

--
-- Индексы таблицы `result_risk_method`
--
ALTER TABLE `result_risk_method`
  ADD KEY `experiment_id` (`experiment_id`),
  ADD KEY `alternative_id` (`alternative_name`),
  ADD KEY `alternative_id_2` (`alternative_name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `utility_matrix`
--
ALTER TABLE `utility_matrix`
  ADD KEY `experiment_id` (`experiment_id`),
  ADD KEY `alternative_i_id` (`alternative_i_id`),
  ADD KEY `criterion_j_id` (`criterion_j_id`);

--
-- Индексы таблицы `аlternatives`
--
ALTER TABLE `аlternatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiment_id` (`experiment_id`),
  ADD KEY `experiment_id_2` (`experiment_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `criterions`
--
ALTER TABLE `criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT для таблицы `experiments`
--
ALTER TABLE `experiments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT для таблицы `methods`
--
ALTER TABLE `methods`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `аlternatives`
--
ALTER TABLE `аlternatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=185;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `criterions`
--
ALTER TABLE `criterions`
  ADD CONSTRAINT `criterions_ibfk_2` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `experiments`
--
ALTER TABLE `experiments`
  ADD CONSTRAINT `experiments_ibfk_1` FOREIGN KEY (`method_id`) REFERENCES `methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `experiments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `probabilities`
--
ALTER TABLE `probabilities`
  ADD CONSTRAINT `probabilities_ibfk_1` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `probabilities_ibfk_2` FOREIGN KEY (`criterion_id`) REFERENCES `criterions` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `result_mah`
--
ALTER TABLE `result_mah`
  ADD CONSTRAINT `result_mah_ibfk_1` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `result_matrix_method`
--
ALTER TABLE `result_matrix_method`
  ADD CONSTRAINT `result_matrix_method_ibfk_1` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `result_risk_method`
--
ALTER TABLE `result_risk_method`
  ADD CONSTRAINT `result_risk_method_ibfk_1` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `utility_matrix`
--
ALTER TABLE `utility_matrix`
  ADD CONSTRAINT `utility_matrix_ibfk_1` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `utility_matrix_ibfk_2` FOREIGN KEY (`alternative_i_id`) REFERENCES `аlternatives` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `utility_matrix_ibfk_3` FOREIGN KEY (`criterion_j_id`) REFERENCES `criterions` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `аlternatives`
--
ALTER TABLE `аlternatives`
  ADD CONSTRAINT `@g0lternatives_ibfk_2` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
