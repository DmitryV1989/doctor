-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 19 2023 г., 21:52
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `Doctor`
--

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL,
  `day_time` datetime NOT NULL,
  `patient_id` int NOT NULL,
  `reason` text NOT NULL,
  `visit_status` int NOT NULL,
  `survey` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `resume` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `day_time`, `patient_id`, `reason`, `visit_status`, `survey`, `resume`, `created_at`) VALUES
(1, '2023-04-14 10:00:00', 1, 'Кашель', 1, 'Назначено обследование', 'Аллергия', '2023-04-13 15:34:09'),
(2, '2023-04-18 10:30:00', 1, 'Насморк, вторичный приём. ', 1, 'Назначен Тавегил', 'Проведено обследование, подтверждена аллергия.', '2023-04-13 15:36:20'),
(3, '2023-06-03 11:30:00', 2, 'Бессонница', 1, 'Назначена томография', 'Пациент здоров', '2023-04-13 15:39:41'),
(4, '2023-04-17 13:00:00', 2, 'Бессонница', 1, 'Корвалол', 'пациент здоров', '2023-04-25 17:58:33'),
(8, '2023-06-28 17:00:00', 3, 'Головные боли, усталость.', 0, 'ещё не прошло', 'ещё не прошло', '2023-04-25 18:11:21'),
(9, '2023-06-21 10:00:00', 1, 'Наблюдение после лечения', 0, 'ждём результатов', 'ждём результатов', '2023-06-13 16:20:28'),
(10, '2023-06-18 18:30:00', 2, 'test1', 0, 'test1', 'test1', '2023-06-13 16:25:50'),
(11, '2023-06-14 10:30:00', 3, 'test4', 2, 'test4', 'test4', '2023-06-13 16:26:34');

-- --------------------------------------------------------

--
-- Структура таблицы `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `pers_numb` int NOT NULL,
  `DOB` date NOT NULL,
  `sex` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `patient`
--

INSERT INTO `patient` (`id`, `name`, `pers_numb`, `DOB`, `sex`, `created_at`) VALUES
(1, 'Дмитрий', 1234, '1989-08-14', 1, '2023-06-15 13:11:26'),
(2, 'Иван', 5678, '1999-11-05', 1, '2023-06-15 13:18:25'),
(3, 'Наталья', 9876, '1995-01-09', 2, '2023-06-15 13:18:52'),
(4, 'Виктория', 6541, '1998-09-05', 2, '2023-06-15 13:19:17'),
(5, 'Алекс', 5897, '2002-05-17', 1, '2023-06-15 13:23:27');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
