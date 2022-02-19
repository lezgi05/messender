-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 19 2022 г., 20:09
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `messenger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dialogs`
--

CREATE TABLE `dialogs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dialogs`
--

INSERT INTO `dialogs` (`id`, `user_1`, `user_2`, `created_at`, `updated_at`) VALUES
(1, '3', '1', '2022-02-17 05:06:22', '2022-02-17 05:06:22'),
(2, '3', '2', '2022-02-17 05:06:32', '2022-02-17 05:06:32'),
(3, '1', '2', '2022-02-17 18:04:04', '2022-02-17 18:04:04'),
(4, '4', '2', '2022-02-18 12:02:33', '2022-02-18 12:02:33'),
(5, '4', '1', '2022-02-18 12:02:41', '2022-02-18 12:02:41'),
(6, '4', '3', '2022-02-18 12:02:51', '2022-02-18 12:02:51'),
(7, '5', '1', '2022-02-18 16:17:53', '2022-02-18 16:17:53'),
(8, '5', '2', '2022-02-18 16:18:22', '2022-02-18 16:18:22');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE `friends` (
  `id` bigint UNSIGNED NOT NULL,
  `add_friends_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_friends_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `friends`
--

INSERT INTO `friends` (`id`, `add_friends_id`, `app_friends_id`, `created_at`, `updated_at`) VALUES
(2, '3', '2', '2022-02-17 05:06:11', '2022-02-17 05:06:11'),
(3, '1', '2', '2022-02-17 18:03:58', '2022-02-17 18:03:58'),
(4, '4', '2', '2022-02-18 12:02:24', '2022-02-18 12:02:24'),
(6, '4', '3', '2022-02-18 12:02:25', '2022-02-18 12:02:25'),
(7, '5', '1', '2022-02-18 16:17:39', '2022-02-18 16:17:39'),
(8, '5', '2', '2022-02-18 16:18:15', '2022-02-18 16:18:15'),
(33, '1', '4', '2022-02-19 12:06:48', '2022-02-19 12:06:48'),
(34, '1', '3', '2022-02-19 13:59:36', '2022-02-19 13:59:36');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `sender`, `location`, `text`, `created_at`, `updated_at`) VALUES
(1, '3', '1', 'Салам', '2022-02-17 05:06:22', '2022-02-17 05:06:22'),
(2, '3', '2', 'Как ты', '2022-02-17 05:06:32', '2022-02-17 05:06:32'),
(3, '3', '1', 'Да', '2022-02-17 05:06:41', '2022-02-17 05:06:41'),
(4, '3', '1', 'kldsnfnsad', '2022-02-17 05:26:16', '2022-02-17 05:26:16'),
(5, '3', '2', 'f', '2022-02-17 05:28:22', '2022-02-17 05:28:22'),
(6, '3', '1', 'f', '2022-02-17 05:28:35', '2022-02-17 05:28:35'),
(7, '3', '1', 'd', '2022-02-17 05:49:05', '2022-02-17 05:49:05'),
(8, '3', '2', 'd', '2022-02-17 05:49:12', '2022-02-17 05:49:12'),
(9, '3', '2', 'у', '2022-02-17 08:08:09', '2022-02-17 08:08:09'),
(10, '3', '2', 'f', '2022-02-17 08:12:58', '2022-02-17 08:12:58'),
(11, '3', '1', 'f', '2022-02-17 08:13:04', '2022-02-17 08:13:04'),
(12, '3', '1', 'f', '2022-02-17 08:13:12', '2022-02-17 08:13:12'),
(13, '3', '2', 'g', '2022-02-17 08:13:59', '2022-02-17 08:13:59'),
(14, '3', '2', 'h', '2022-02-17 08:14:07', '2022-02-17 08:14:07'),
(15, '3', '1', 'd', '2022-02-17 08:15:49', '2022-02-17 08:15:49'),
(16, '3', '1', 'f', '2022-02-17 08:22:31', '2022-02-17 08:22:31'),
(17, '3', '1', 'e', '2022-02-17 08:26:43', '2022-02-17 08:26:43'),
(18, '3', '2', 'f', '2022-02-17 08:28:35', '2022-02-17 08:28:35'),
(19, '3', '1', 'd', '2022-02-17 08:28:44', '2022-02-17 08:28:44'),
(20, '3', '2', 'e', '2022-02-17 08:28:55', '2022-02-17 08:28:55'),
(21, '3', '1', 'f', '2022-02-17 08:29:40', '2022-02-17 08:29:40'),
(22, '3', '2', 'nd', '2022-02-17 08:29:57', '2022-02-17 08:29:57'),
(23, '3', '1', 'd', '2022-02-17 08:32:38', '2022-02-17 08:32:38'),
(24, '3', '1', 'd', '2022-02-17 08:34:58', '2022-02-17 08:34:58'),
(25, '3', '2', 'e', '2022-02-17 08:45:49', '2022-02-17 08:45:49'),
(26, '3', '1', 'r', '2022-02-17 08:46:28', '2022-02-17 08:46:28'),
(27, '3', '2', 'r', '2022-02-17 08:47:13', '2022-02-17 08:47:13'),
(28, '3', '1', 'f', '2022-02-17 08:48:26', '2022-02-17 08:48:26'),
(29, '3', '1', 'ds', '2022-02-17 08:55:36', '2022-02-17 08:55:36'),
(30, '3', '2', 's', '2022-02-17 08:56:50', '2022-02-17 08:56:50'),
(31, '1', '3', 'даров', '2022-02-17 18:04:04', '2022-02-17 18:04:04'),
(32, '1', '1', 'ы', '2022-02-17 18:04:14', '2022-02-17 18:04:14'),
(33, '1', '3', 'h', '2022-02-18 03:13:54', '2022-02-18 03:13:54'),
(34, '1', '1', 'fd', '2022-02-18 03:44:41', '2022-02-18 03:44:41'),
(35, '1', '1', 'fd', '2022-02-18 03:44:47', '2022-02-18 03:44:47'),
(36, '1', '3', 'd', '2022-02-18 04:18:16', '2022-02-18 04:18:16'),
(37, '1', '1', 'd', '2022-02-18 04:18:22', '2022-02-18 04:18:22'),
(38, '1', '3', 'd', '2022-02-18 04:18:35', '2022-02-18 04:18:35'),
(39, '1', '3', 'f', '2022-02-18 04:18:48', '2022-02-18 04:18:48'),
(40, '1', '1', 'fd', '2022-02-18 04:25:23', '2022-02-18 04:25:23'),
(41, '1', '3', 'fd', '2022-02-18 04:25:33', '2022-02-18 04:25:33'),
(42, '1', '1', 'fd', '2022-02-18 04:33:40', '2022-02-18 04:33:40'),
(43, '1', '3', 'f', '2022-02-18 04:33:47', '2022-02-18 04:33:47'),
(44, '1', '1', 'ds', '2022-02-18 05:34:43', '2022-02-18 05:34:43'),
(45, '1', '1', 'ds', '2022-02-18 05:34:51', '2022-02-18 05:34:51'),
(46, '1', '3', 'd', '2022-02-18 11:00:29', '2022-02-18 11:00:29'),
(47, '1', '1', 'f', '2022-02-18 11:00:49', '2022-02-18 11:00:49'),
(48, '1', '3', 'lf', '2022-02-18 11:42:13', '2022-02-18 11:42:13'),
(49, '1', '1', 'fd', '2022-02-18 11:42:28', '2022-02-18 11:42:28'),
(50, '1', '1', 'fd', '2022-02-18 11:42:37', '2022-02-18 11:42:37'),
(51, '1', '3', 'fd', '2022-02-18 11:56:23', '2022-02-18 11:56:23'),
(52, '1', '1', 'fd', '2022-02-18 11:56:33', '2022-02-18 11:56:33'),
(53, '1', '1', 'ds', '2022-02-18 11:58:50', '2022-02-18 11:58:50'),
(54, '1', '3', 'ds', '2022-02-18 11:59:02', '2022-02-18 11:59:02'),
(55, '1', '1', 're', '2022-02-18 12:00:00', '2022-02-18 12:00:00'),
(56, '1', '3', 'ds', '2022-02-18 12:00:55', '2022-02-18 12:00:55'),
(57, '1', '1', 'ds', '2022-02-18 12:01:03', '2022-02-18 12:01:03'),
(58, '4', '4', 'Дарова', '2022-02-18 12:02:33', '2022-02-18 12:02:33'),
(59, '4', '5', 'дав', '2022-02-18 12:02:41', '2022-02-18 12:02:41'),
(60, '4', '6', 'гав', '2022-02-18 12:02:51', '2022-02-18 12:02:51'),
(61, '4', '4', 'Как ты?', '2022-02-18 12:05:35', '2022-02-18 12:05:35'),
(62, '4', '5', 'kdsfj;sd', '2022-02-18 12:05:58', '2022-02-18 12:05:58'),
(63, '4', '6', 'Наконец то', '2022-02-18 12:06:25', '2022-02-18 12:06:25'),
(64, '4', '5', 'ав', '2022-02-18 12:06:34', '2022-02-18 12:06:34'),
(65, '5', '7', 'привет', '2022-02-18 16:17:53', '2022-02-18 16:17:53'),
(66, '5', '8', 'ваы', '2022-02-18 16:18:22', '2022-02-18 16:18:22'),
(67, '5', '7', 'аывавы', '2022-02-18 16:18:52', '2022-02-18 16:18:52'),
(68, '5', '7', 'хп', '2022-02-18 16:34:57', '2022-02-18 16:34:57'),
(69, '5', '7', 'да', '2022-02-18 16:36:36', '2022-02-18 16:36:36'),
(70, '1', '7', 'гшиг', '2022-02-18 16:44:10', '2022-02-18 16:44:10'),
(71, '1', '1', 'f23', '2022-02-19 13:57:02', '2022-02-19 13:57:02');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_23_153556_create_dialogs_table', 1),
(6, '2022_01_23_154634_create_messages_table', 1),
(7, '2022_01_24_055644_create_friends_table', 1),
(8, '2022_01_24_102710_create_user_details_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `tel`, `name`, `surname`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '+7 (928) 831-30-97', 'Рамазан', 'Магомедов', '$2y$10$SU2n.Sg4XAw1rZIBvG8CK.b5NeauCXD1f1werKF2OwqtQXDyQQY9q', NULL, '2022-02-17 05:02:59', '2022-02-17 05:03:09'),
(2, '+7 (999) 999-99-99', 'Серж', 'Курбанов', '$2y$10$OM0yM1flDixFlQFRsFV2s.xj4.6s1TPmn5bhDSiwYniFvbkE3HZYq', NULL, '2022-02-17 05:04:54', '2022-02-17 05:05:09'),
(3, '+7 (888) 888-88-88', 'Курбан', 'Хулатаев', '$2y$10$OxsAjYAjhEEJqqDuOB5bmO7YKi690vXmR/EwEcDelpVjnhMO/TlKe', NULL, '2022-02-17 05:05:42', '2022-02-17 05:06:00'),
(4, '+7 (777) 777-77-77', 'Тестим', 'Тест', '$2y$10$CGd0KuP0P0x4gWgRi7gXj.ejXcwEQ5T1ZK40hTGxPb2uR2z0bOwTC', NULL, '2022-02-18 12:02:08', '2022-02-18 12:02:19'),
(5, '+7 (928) 504-75-09', 'Аминат', 'Адаева', '$2y$10$yfOfytdFrVjlpw1gmMCUaeF6wZCqu4Kh9mQS9uZCtK56iy0Iemig.', NULL, '2022-02-18 16:17:13', '2022-02-18 16:17:21');

-- --------------------------------------------------------

--
-- Структура таблицы `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mounth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dialogs`
--
ALTER TABLE `dialogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dialogs`
--
ALTER TABLE `dialogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
