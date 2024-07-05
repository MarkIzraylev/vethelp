-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 21 2024 г., 00:59
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vethelp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `sending_timestamp` datetime NOT NULL,
  `pet_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isAnswered` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `sending_timestamp`, `pet_type_id`, `user_id`, `isAnswered`) VALUES
(11, '2024-04-11 02:18:12', 2, 19, b'0'),
(12, '2024-04-11 02:18:25', 1, 19, b'0'),
(13, '2024-04-11 02:19:01', 1, 19, b'0'),
(14, '2024-04-11 02:39:34', 1, 19, b'0'),
(15, '2024-04-11 02:40:03', 2, 19, b'0'),
(16, '2024-04-11 02:43:56', 2, 19, b'0'),
(17, '2024-04-11 02:45:04', 1, 19, b'0'),
(18, '2024-04-11 02:46:16', 1, 19, b'0'),
(19, '2024-04-16 11:35:05', 2, 19, b'0'),
(20, '2024-04-16 22:06:52', 1, 19, b'0'),
(21, '2024-04-16 22:08:05', 1, 19, b'0'),
(24, '2024-05-20 21:53:19', 2, 24, b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `pet_type`
--

CREATE TABLE `pet_type` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pet_type`
--

INSERT INTO `pet_type` (`id`, `name`) VALUES
(1, 'Собака/пёс'),
(2, 'Кошка/кот');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `specialist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_date` date NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `cover_filename` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `specialist_id`, `user_id`, `review_date`, `rating`, `review`, `cover_filename`) VALUES
(1, 1, 19, '2024-04-16', 5, 'Я обратилась в клинику ВетХелп с моим золотистым ретривером, который нуждался в срочной помощи. Меня приняла врач-ветеринар Василиса Йогуртова, специализирующаяся на анестезиологии и кардиологии.\n\nБыла очень обеспокоена состоянием моего питомца, но доктор Йогуртова сразу же расположила меня к себе своим профессионализмом и чуткостью. Она внимательно осмотрела моего пса, задала подробные вопросы о его симптомах и истории болезни, а затем назначила необходимые обследования и лечение.\n\nВо время процедур доктор Йогуртова была предельно аккуратна и заботлива, постоянно успокаивая и подбадривая моего питомца. Она объясняла мне каждый шаг лечения, отвечала на все мои вопросы и развеивала любые сомнения. Благодаря ее профессионализму и внимательному подходу, мой пёс быстро пошёл на поправку.\n\nЯ безмерно благодарна доктору Йогуртовой за ее высокий уровень компетенции, чуткость и искреннюю заботу о моем питомце. Я рекомендую её как опытного, внимательного и ответственного ветеринарного врача, которому можно доверить здоровье своих любимцев.', 'ai_review_1.jpg'),
(2, 1, 20, '2024-04-14', 5, 'Недавно мне пришлось обратиться в клинику ВетХелп с моей полосатой рыжей кошкой. Она нуждалась в срочной помощи, и меня приняла врач-ветеринар Василиса Йогуртова, специализирующаяся на анестезиологии и кардиологии.\n\nДоктор Йогуртова сразу произвела на меня впечатление своим профессионализмом и чуткостью. Она внимательно осмотрела мою кошку, задала подробные вопросы о ее состоянии и назначила необходимые процедуры, в том числе надевание ветеринарного воротника.\n\nВо время всех манипуляций Василиса Йогуртова действовала очень аккуратно и бережно, успокаивая мою кошку и объясняя мне каждый шаг лечения. Благодаря ее профессионализму и заботливому подходу, моя любимица быстро пошла на поправку.\n\nЯ безмерно благодарен доктору Йогуртовой за ее высокий уровень компетенции, внимательность и искреннюю заботу о моем питомце. Я рекомендую ее как опытного, ответственного и чуткого ветеринарного врача, которому можно доверить здоровье своих любимцев.', 'ai_review_2.jpg'),
(3, 3, 20, '2024-04-08', 5, 'Хочется выразить огромную благодарность специалисту с большой буквы Свободовой Ольге Николаевне!\r\n\r\nСпасли нашу любимицу!', 'ai_review_3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `heading` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`id`, `heading`, `description`, `name`) VALUES
(1, 'Добро пожаловать в ВетХелп!', 'Ветеринарная клиника в Ярославле: ул. Весенняя, дом 1.', 'hero'),
(2, 'Почему мы?', 'В нашей клинике осуществляется приём врачей общей практики, а также специалистов в узкопрофильных областях:\n<ul class=\"list--2col\"><li>Стоматология</li><li>Офтальмология</li><li>Гастроэнтерология</li><li>Дерматология</li><li>Физическая реабилитация</li><li>Ортопедия</li><li>Кардиология</li><li>Нефрология</li><li>Родентология</li></ul>\nТакже проводим курс реабилитации и восстановления животных после болезни.  В нашей клинике есть стационар для домашних животных.\n\nВсе процедуры проводятся квалифицированными специалистами.', 'about_us'),
(3, 'Услуги клиники', 'Мы оказываем полный спектр лечебно-диагностических услуг. К каждому питомцу индивидуальный подход.', 'services'),
(4, 'Специалисты', 'Наша клиника обладает мастерами своего дела и это подтверждается высоким рейтингом, сформированным из всех оценок наших клиентов за последний год.', 'specialists'),
(5, 'Запись на приём', 'Для записи на приём Вы можете позвонить, или написать нам по контактным данным ниже, или заполнить форму для обратного звонка.', 'appointment_form'),
(6, 'Обратный звонок', 'Расписание работы операторов:\nПн-Сб: 9:00-21:00\nВс: 9:00-18:00\n\nВремя ожидания обратного звонка: до 15 минут.', 'appointment_form_timetable'),
(7, 'Контактные данные', '<img src=\"img/icons/mobile_phone.png\" alt=\"Иконка телефона\" class=\"section__main-block__block__wrapper__paragraph__icon\"> +7 (999) 999 99-99\n<img src=\"img/icons/tg.png\" alt=\"Иконка телеграма\" class=\"section__main-block__block__wrapper__paragraph__icon\"> @northurljous', 'appointment_form_contacts'),
(8, '', '<a href=\"tel:89999999999\" class=\"section__main-block__block__wrapper__buttons-block__button--for-small btn\">Позвонить</a><a href=\"https://t.me/northurljous\" class=\"section__main-block__block__wrapper__buttons-block__button btn\">Написать в тг</a>', 'appointment_form_contacts_buttons');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `price` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id`, `name`, `price`, `service_type_id`) VALUES
(2, 'Консультация врача общей практики', 9000, 1),
(3, 'Консультация узкого специалиста', 1000, 1),
(4, 'Повторный приём узкого специалиста', 800, 1),
(5, 'Повторный приём врача общей практики', 700, 1),
(6, 'Введение лекарственных препаратов через рот', 50, 2),
(7, 'Внутримышечное, подкожное введение', 50, 2),
(8, 'Внутривенное введение', 300, 2),
(11, 'Внутрисуставное введение', 500, 2),
(12, 'Введение лекарств внутривенно-капельно до 500 мл', 300, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `service_type`
--

CREATE TABLE `service_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cover_filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `service_type`
--

INSERT INTO `service_type` (`id`, `name`, `cover_filename`) VALUES
(1, 'Консультации', 'doctor1.jpeg'),
(2, 'Лечебные процедуры', 'injection.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `specialist`
--

CREATE TABLE `specialist` (
  `id` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `patronymic` varchar(100) DEFAULT NULL,
  `specialization` varchar(2000) NOT NULL,
  `education` varchar(2000) NOT NULL,
  `cover_filename` varchar(300) NOT NULL,
  `specialist_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `specialist`
--

INSERT INTO `specialist` (`id`, `surname`, `first_name`, `patronymic`, `specialization`, `education`, `cover_filename`, `specialist_type_id`) VALUES
(1, 'Йогуртова', 'Василиса', 'Васильевна', 'Ветеринарный фельдшер-анестезиолог, дополнительная специализация - кардиолог.', 'Окончила Великосельский аграрный колледж по специальности \"Ветеринарный фельдшер\" в 2018 году. В процессе обучения получила углубленные знания и практические навыки в области анестезиологии и кардиологии животных.', 'ai_3.jpg', 1),
(2, 'Кружкова', 'Диана', NULL, 'Ветеринарный фельдшер-терапевт, дополнительная специализация в области зоогигиены.', 'Окончила Московский государственный аграрный университет имени К.А. Тимирязева по специальности \"Ветеринарный фельдшер\" в 2021 году.', 'ai_4.jpg', 1),
(3, 'Свободова', 'Ольга', NULL, 'Терапевт, дерматолог, дополнительная специализация гастроэнтеролог.Окончила Костромскую ГСХА в 2008 году.', 'Окончила Костромскую ГСХА в 2008 году.', 'ai_1.jpg', 2),
(4, 'Правоведова', 'Дарина', NULL, 'Хирург, стоматолог, вторая специализация офтальмология.', 'В 2012 году окончила Вологодскую ГМХА, ветеринарный врач, хирург, стоматолог, дополнительная специализация офтальмолог.', 'ai_2.jpg', 2),
(5, 'Мирова', 'Полина', NULL, 'Хирург, ортопед, дополнительная специализация рентгенолог.', 'Окончила Вологодскую ГМХА в 2020 году.', 'ai_5.jpg', 2),
(6, 'Истомов', 'Максим', NULL, 'Ветеринарный врач хирург ортопед, дополнительные специализации неврология и реабилитация.', 'Окончил СПб ГАВМ в 2015 году.', 'ai_6.jpg', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `specialist_type`
--

CREATE TABLE `specialist_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `specialist_type`
--

INSERT INTO `specialist_type` (`id`, `name`) VALUES
(1, 'Вет. фельдшеры'),
(2, 'Вет. врачи'),
(3, 'Руководитель');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `surname` varchar(70) DEFAULT NULL,
  `first_name` varchar(70) NOT NULL,
  `patronymic` varchar(70) DEFAULT NULL,
  `phone_number` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `surname`, `first_name`, `patronymic`, `phone_number`, `email`, `password_hash`) VALUES
(19, 'Дождьев', 'Йоханн', 'Эрикович', '+79007008090', 'aurora@yandex.ru', '$2y$10$UV5a3GiyrmeP1qIbJvalF.B3cLM9hcNZPfJFVIEPXwokUBUZhnjxu'),
(20, 'Дынев', 'Платон', '', '+79999999999', 'bjork@gmail.com', '$2y$10$cZiqIb.gQFo62IOev0oTruc7srxpv7U4eQa1yjsMt0u.4yghNu23y'),
(24, 'Андреев', 'Марк', 'Александрович', '+79056309662', 'markizraylev@yandex.ru', '$2y$10$dxEBEu4Fl4T6h.KISvUCz.IgWXN8v9qP3t0KqyEaxnkY9Pm4lpy7O');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_type_id` (`pet_type_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `pet_type`
--
ALTER TABLE `pet_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `specialist_id` (`specialist_id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_type_id` (`service_type_id`);

--
-- Индексы таблицы `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialist_type_id` (`specialist_type_id`);

--
-- Индексы таблицы `specialist_type`
--
ALTER TABLE `specialist_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `pet_type`
--
ALTER TABLE `pet_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `service_type`
--
ALTER TABLE `service_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `specialist_type`
--
ALTER TABLE `specialist_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`pet_type_id`) REFERENCES `pet_type` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`specialist_id`) REFERENCES `specialist` (`id`);

--
-- Ограничения внешнего ключа таблицы `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `specialist`
--
ALTER TABLE `specialist`
  ADD CONSTRAINT `specialist_ibfk_1` FOREIGN KEY (`specialist_type_id`) REFERENCES `specialist_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
