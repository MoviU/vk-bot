-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 24 2020 г., 14:28
-- Версия сервера: 8.0.17-cll-lve
-- Версия PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u163153kwb_botcrafter`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bot`
--

CREATE TABLE `bot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `timeaction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `msg_count` int(11) NOT NULL DEFAULT '0',
  `subscription` int(11) NOT NULL DEFAULT '0',
  `unsubscribe` int(11) NOT NULL DEFAULT '0',
  `tariff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bot`
--

INSERT INTO `bot` (`id`, `name`, `timeaction`, `user_id`, `enabled`, `msg_count`, `subscription`, `unsubscribe`, `tariff_id`) VALUES
(1, 'Бот №1', '2020-05-14 15:44:15', 17, 1, 0, 0, 0, 0),
(2, 'Бот №2', '2020-05-15 09:42:10', 17, 1, 0, 0, 0, 0),
(3, 'Бот №1', '2020-05-15 23:24:56', 22, 1, 0, 0, 0, 0),
(4, 'боткрот', '2020-05-31 19:11:32', 24, 1, 0, 0, 0, 0),
(5, 'Бот Мечты', '2020-06-02 15:39:47', 21, 1, 432, 0, 0, 2),
(6, 'Бот №2', '2020-06-03 18:04:03', 21, 0, 0, 0, 0, 0),
(24, 'Бот №2', '2020-07-03 22:44:43', 24, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `botactions`
--

CREATE TABLE `botactions` (
  `id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `uses` int(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `writemode` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `botactions`
--

INSERT INTO `botactions` (`id`, `bot_id`, `type`, `text`, `uses`, `enabled`, `writemode`) VALUES
(1, 5, 0, '[\"\\r\\n                \\r\\n                \\r\\n                \\r\\n                \\r\\n                \\r\\n                \\r\\n                \\u041f\\u0440\\u0438\\u0432\\u0435\\u0442 \\u0442\\u0435\\u0431\\u0435 \\u0447\\u0435\\u043b\\u043e\\u0432\\u0435\\u0447\\u0435\\u043a                                                                                                                \",\"\\r\\n                \\r\\n                \\r\\n                \\r\\n                \\r\\n                \\r\\n                \\u0445\\u0430\\u0445\\u0430 {name}<br>                                                                                                \"]', 0, 1, 1),
(2, 5, 3, '[\"\\r\\n                {surname}{name}\\r\\n                \\r\\n                {name}\\r\\n                {date} {time} \\u041f\\u0435\\u0447\\u0430\\u043b\\u044c\\u043d\\u043e {name} {surname} \\u0438\\u0437 {city} \\u0441 \\u0430\\u0439\\u0434\\u0438 {user_id}, \\u043d\\u043e \\u044f \\u0432\\u0441\\u0435\\u0433\\u043e \\u043b\\u0438\\u0448\\u044c \\u0431\\u043e\\u0442 {group_name}  \\u0438 \\u0442\\u0435\\u0431\\u044f \\u043d\\u0435 \\u043f\\u043e\\u043d\\u0438{name}\\u043c\\u0430\\u044e                                                                \",\"\\r\\n                {surname}{name}\\r\\n                hfgh{surname}ghh                {name}                \"]', 160, 1, 0),
(3, 5, 1, '', 0, 1, 0),
(4, 5, 2, '', 0, 1, 0),
(5, 5, 4, '', 0, 1, 0),
(6, 5, 6, 'ответ на картинку<br>', 0, 1, 0),
(7, 6, 0, '', 0, 1, 0),
(8, 4, 0, '', 0, 1, 0),
(9, 4, 3, '', 0, 1, 0),
(10, 4, 6, '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `botcommand`
--

CREATE TABLE `botcommand` (
  `id` int(11) NOT NULL,
  `command` varchar(100) NOT NULL,
  `response` varchar(300) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `uses` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `botcommand`
--

INSERT INTO `botcommand` (`id`, `command`, `response`, `bot_id`, `enabled`, `uses`, `user_id`) VALUES
(1, 'как дела', 'спасибо, хорошо', 5, 0, 0, 0),
(3, 'меню,menu', 'Для вызова меню напишите help', 5, 1, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dialogs`
--

CREATE TABLE `dialogs` (
  `id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timeaction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `dialogs`
--

INSERT INTO `dialogs` (`id`, `bot_id`, `user_id`, `timeaction`, `type`) VALUES
(3, 5, 268877280, '2020-06-09 15:17:31', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `answer` text NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `faq_category`
--

CREATE TABLE `faq_category` (
  `id` int(11) NOT NULL,
  `name` varchar(130) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `timeaction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `source_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `img` varchar(120) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `user_id`, `group_id`, `img`, `name`) VALUES
(1, 1, 3183750, '', ''),
(2, 0, 42565717, '', ''),
(3, 0, 49821894, '', ''),
(4, 0, 175, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `group_counter`
--

CREATE TABLE `group_counter` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(30) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `group_counter`
--

INSERT INTO `group_counter` (`id`, `group_id`, `users`, `updated`, `name`, `type`) VALUES
(2, 189991176, 2, '2020-07-08 16:49:00', 'Все пользователи', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mailinglist`
--

CREATE TABLE `mailinglist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `mailinglist`
--

INSERT INTO `mailinglist` (`id`, `user_id`, `sex`, `group_id`, `city_id`, `city_name`, `country_id`, `country_name`) VALUES
(5, 268877280, 2, 189991176, 1, 'Москва', 1, 'Россия'),
(6, 328228095, 2, 189991176, 1, 'Москва', 1, 'Россия');

-- --------------------------------------------------------

--
-- Структура таблицы `modules_enabled`
--

CREATE TABLE `modules_enabled` (
  `id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `pay_bots`
--

CREATE TABLE `pay_bots` (
  `id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `supportlink` varchar(100) NOT NULL,
  `vkcontact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`supportlink`, `vkcontact`, `email`, `id`) VALUES
('https://vk.com', 'https://vk.com', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tariff`
--

CREATE TABLE `tariff` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `members` int(11) NOT NULL DEFAULT '0',
  `command` tinyint(4) NOT NULL DEFAULT '0',
  `modules` varchar(100) NOT NULL DEFAULT '',
  `macros` tinyint(1) NOT NULL DEFAULT '0',
  `media` tinyint(1) NOT NULL DEFAULT '0',
  `mailing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tariff`
--

INSERT INTO `tariff` (`id`, `name`, `price`, `members`, `command`, `modules`, `macros`, `media`, `mailing`) VALUES
(2, 'Бесплатный', 0, 50, 1, '{\"joke\":1,\"signa\":0,\"facts\":1,\"quote\":0}', 1, 1, 0),
(3, 'Начальный', 399, 100, 0, '{\"joke\":1,\"signa\":1,\"facts\":1,\"quote\":1} 	', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  `last_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `group_id`, `topic_id`, `last_update`, `last_number`) VALUES
(1, 3183750, 27354620, 0, 37023),
(2, 3183750, 5667521, 0, 37288),
(3, 3183750, 39787909, 0, 37287),
(4, 42565717, 33129242, 0, 13681),
(5, 49821894, 36071256, 0, 20227),
(6, 175, 27005954, 0, 11855);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(155) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `authKey` varchar(255) NOT NULL,
  `accessToken` varchar(255) NOT NULL,
  `auth_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0',
  `vktoken` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vkaccount`
--

CREATE TABLE `vkaccount` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` varchar(20) NOT NULL,
  `access_token` varchar(256) NOT NULL,
  `timeaction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(120) NOT NULL,
  `last_name` varchar(120) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `state` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `vkgroups`
--

CREATE TABLE `vkgroups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `timeaction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(200) NOT NULL,
  `server_id` int(11) NOT NULL,
  `secret_key` varchar(60) NOT NULL,
  `code` varchar(40) NOT NULL,
  `access_token` varchar(300) NOT NULL,
  `bot_id` int(11) NOT NULL DEFAULT '0',
  `paid` datetime NOT NULL,
  `messages` int(11) NOT NULL DEFAULT '0',
  `subscribe` int(11) NOT NULL DEFAULT '0',
  `unsubscribe` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `vkimplicit`
--

CREATE TABLE `vkimplicit` (
  `id` int(11) NOT NULL,
  `state` varchar(70) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `botactions`
--
ALTER TABLE `botactions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `botcommand`
--
ALTER TABLE `botcommand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dialogs`
--
ALTER TABLE `dialogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `group_counter`
--
ALTER TABLE `group_counter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mailinglist`
--
ALTER TABLE `mailinglist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `modules_enabled`
--
ALTER TABLE `modules_enabled`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tariff`
--
ALTER TABLE `tariff`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_id` (`auth_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `vkaccount`
--
ALTER TABLE `vkaccount`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vkgroups`
--
ALTER TABLE `vkgroups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vkimplicit`
--
ALTER TABLE `vkimplicit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bot`
--
ALTER TABLE `bot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `botactions`
--
ALTER TABLE `botactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `botcommand`
--
ALTER TABLE `botcommand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `dialogs`
--
ALTER TABLE `dialogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `group_counter`
--
ALTER TABLE `group_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mailinglist`
--
ALTER TABLE `mailinglist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `modules_enabled`
--
ALTER TABLE `modules_enabled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tariff`
--
ALTER TABLE `tariff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `vkaccount`
--
ALTER TABLE `vkaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `vkgroups`
--
ALTER TABLE `vkgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `vkimplicit`
--
ALTER TABLE `vkimplicit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;
 

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;