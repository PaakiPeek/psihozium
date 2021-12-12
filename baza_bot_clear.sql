-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.0.63:3306
-- Время создания: Дек 12 2021 г., 12:16
-- Версия сервера: 10.1.48-MariaDB
-- Версия PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `baza_bot_clear`
--

-- --------------------------------------------------------

--
-- Структура таблицы `likepost`
--

CREATE TABLE `likepost` (
  `chat_id` text NOT NULL,
  `query_id` text NOT NULL,
  `message_id` text NOT NULL,
  `user_id` text NOT NULL,
  `user_like` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `psifull`
--

CREATE TABLE `psifull` (
  `id` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `checkurl` text NOT NULL,
  `covid` text NOT NULL,
  `expert` text NOT NULL,
  `relationship` text NOT NULL,
  `cover` text NOT NULL,
  `sex` text NOT NULL,
  `couple` text NOT NULL,
  `stress` text NOT NULL,
  `loneliness` text NOT NULL,
  `divorce` text NOT NULL,
  `infidelity` text NOT NULL,
  `career` text NOT NULL,
  `purpose` text NOT NULL,
  `parents` text NOT NULL,
  `communication` text NOT NULL,
  `predeccesors` text NOT NULL,
  `teenagers` text NOT NULL,
  `jealousy` text NOT NULL,
  `cinema` text NOT NULL,
  `mustread` text NOT NULL,
  `listenbody` text NOT NULL,
  `howto` text NOT NULL,
  `interview` text NOT NULL,
  `beauty` text NOT NULL,
  `wtf` text NOT NULL,
  `nocat` text NOT NULL,
  `final` text NOT NULL,
  `title` text NOT NULL,
  `annotation` text NOT NULL,
  `post_img` text NOT NULL,
  `telegraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `psiotnosh`
--

CREATE TABLE `psiotnosh` (
  `id` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `checkurl` text NOT NULL,
  `covid` text NOT NULL,
  `expert` text NOT NULL,
  `relationship` text NOT NULL,
  `cover` text NOT NULL,
  `sex` text NOT NULL,
  `couple` text NOT NULL,
  `stress` text NOT NULL,
  `loneliness` text NOT NULL,
  `divorce` text NOT NULL,
  `infidelity` text NOT NULL,
  `career` text NOT NULL,
  `purpose` text NOT NULL,
  `parents` text NOT NULL,
  `communication` text NOT NULL,
  `predeccesors` text NOT NULL,
  `teenagers` text NOT NULL,
  `jealousy` text NOT NULL,
  `cinema` text NOT NULL,
  `mustread` text NOT NULL,
  `listenbody` text NOT NULL,
  `howto` text NOT NULL,
  `interview` text NOT NULL,
  `beauty` text NOT NULL,
  `wtf` text NOT NULL,
  `nocat` text NOT NULL,
  `final` text NOT NULL,
  `title` text NOT NULL,
  `annotation` text NOT NULL,
  `post_img` text NOT NULL,
  `telegraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `psisam`
--

CREATE TABLE `psisam` (
  `id` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `checkurl` text NOT NULL,
  `covid` text NOT NULL,
  `expert` text NOT NULL,
  `relationship` text NOT NULL,
  `cover` text NOT NULL,
  `sex` text NOT NULL,
  `couple` text NOT NULL,
  `stress` text NOT NULL,
  `loneliness` text NOT NULL,
  `divorce` text NOT NULL,
  `infidelity` text NOT NULL,
  `career` text NOT NULL,
  `purpose` text NOT NULL,
  `parents` text NOT NULL,
  `communication` text NOT NULL,
  `predeccesors` text NOT NULL,
  `teenagers` text NOT NULL,
  `jealousy` text NOT NULL,
  `cinema` text NOT NULL,
  `mustread` text NOT NULL,
  `listenbody` text NOT NULL,
  `howto` text NOT NULL,
  `interview` text NOT NULL,
  `beauty` text NOT NULL,
  `wtf` text NOT NULL,
  `nocat` text NOT NULL,
  `final` text NOT NULL,
  `title` text NOT NULL,
  `annotation` text NOT NULL,
  `post_img` text NOT NULL,
  `telegraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `psistory`
--

CREATE TABLE `psistory` (
  `id` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `checkurl` text NOT NULL,
  `covid` text NOT NULL,
  `expert` text NOT NULL,
  `relationship` text NOT NULL,
  `cover` text NOT NULL,
  `sex` text NOT NULL,
  `couple` text NOT NULL,
  `stress` text NOT NULL,
  `loneliness` text NOT NULL,
  `divorce` text NOT NULL,
  `infidelity` text NOT NULL,
  `career` text NOT NULL,
  `purpose` text NOT NULL,
  `parents` text NOT NULL,
  `communication` text NOT NULL,
  `predeccesors` text NOT NULL,
  `teenagers` text NOT NULL,
  `jealousy` text NOT NULL,
  `cinema` text NOT NULL,
  `mustread` text NOT NULL,
  `listenbody` text NOT NULL,
  `howto` text NOT NULL,
  `interview` text NOT NULL,
  `beauty` text NOT NULL,
  `wtf` text NOT NULL,
  `nocat` text NOT NULL,
  `final` text NOT NULL,
  `title` text NOT NULL,
  `annotation` text NOT NULL,
  `post_img` text NOT NULL,
  `telegraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `psiurl`
--

CREATE TABLE `psiurl` (
  `id` int(7) NOT NULL,
  `url` varchar(250) NOT NULL,
  `checkurl` text NOT NULL,
  `covid` text NOT NULL,
  `expert` text NOT NULL,
  `relationship` text NOT NULL,
  `cover` text NOT NULL,
  `sex` text NOT NULL,
  `couple` text NOT NULL,
  `stress` text NOT NULL,
  `loneliness` text NOT NULL,
  `divorce` text NOT NULL,
  `infidelity` text NOT NULL,
  `career` text NOT NULL,
  `purpose` text NOT NULL,
  `parents` text NOT NULL,
  `communication` text NOT NULL,
  `predeccesors` text NOT NULL,
  `teenagers` text NOT NULL,
  `jealousy` text NOT NULL,
  `cinema` text NOT NULL,
  `mustread` text NOT NULL,
  `listenbody` text NOT NULL,
  `howto` text NOT NULL,
  `interview` text NOT NULL,
  `beauty` text NOT NULL,
  `wtf` text NOT NULL,
  `nocat` text NOT NULL,
  `final` text NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `annotation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_img` text NOT NULL,
  `telegraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likepost`
--
ALTER TABLE `likepost`
  ADD UNIQUE KEY `userlike` (`user_like`);

--
-- Индексы таблицы `psifull`
--
ALTER TABLE `psifull`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `psiotnosh`
--
ALTER TABLE `psiotnosh`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `psisam`
--
ALTER TABLE `psisam`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `psistory`
--
ALTER TABLE `psistory`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `psiurl`
--
ALTER TABLE `psiurl`
  ADD UNIQUE KEY `url` (`url`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD UNIQUE KEY `id_4` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `psifull`
--
ALTER TABLE `psifull`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `psiotnosh`
--
ALTER TABLE `psiotnosh`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `psisam`
--
ALTER TABLE `psisam`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `psistory`
--
ALTER TABLE `psistory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
