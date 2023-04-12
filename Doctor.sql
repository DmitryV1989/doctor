-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 05 2023 г., 18:03
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `survey` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `resume` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `day_time`, `patient_id`, `reason`, `visit_status`, `survey`, `resume`, `created_at`) VALUES
(1, '2023-04-01 10:00:00', 1, 'Бессонница', 1, 'назначен осмотр', 'назначен осмотр', '2023-04-01 00:45:48'),
(2, '2023-04-01 11:00:00', 2, 'насморк', 1, '', 'назначен осмотр', '2023-04-01 00:48:44'),
(3, '2023-04-05 17:00:00', 4, 'кашель, температура', 0, 'назначено противовирусное', 'ждём результатов', '2023-04-01 11:42:41'),
(4, '2023-04-05 17:30:00', 3, 'болит голова', 0, 'назначен пенталгин', 'помогло', '2023-04-01 11:45:12'),
(5, '2023-04-03 12:00:00', 1, 'Бессонница', 1, 'назначено успокоительное', 'помогло', '2023-04-01 11:46:23');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `patient`
--

INSERT INTO `patient` (`id`, `name`, `pers_numb`, `DOB`, `sex`, `created_at`) VALUES
(1, 'Дмитрий', 1234, '1989-08-14', 1, '2023-03-31 23:39:27'),
(2, 'Алекс', 2345, '1995-05-03', 1, '2023-03-31 23:39:49'),
(3, 'Наталья', 9858, '1993-09-28', 2, '2023-03-31 23:40:30'),
(4, 'Виктория', 9292, '1983-09-02', 2, '2023-04-01 11:47:35');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
