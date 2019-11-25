<?php

/* КОНСТАНТЫ АДРЕСОВ ПУТЕЙ К ФАЙЛАМ БЛОКА АВТОРИЗАЦИИ */

define('SUBS_CREDENTIALS_FILEPATH', PHP_FOLDER . '/authorization/subs_credentials.php'); // Подпрограммы, связанные с проверкой и изменением авторизационных данных Пользователя
define('PW_FILEPATH', PHP_FOLDER . '/authorization/pw.php'); // Авторизационные данные. !!! Для публичных репозиториев данного кода вместо файла pw.php помещается файл pw_pseudo.php, где реальные пароли и наименования заменены на их псевдозначения

// Работа с почтой
define('SMTP_CONNECTION_FILEPATH', PHP_FOLDER . '/authorization/send_email.php'); // Модуль отправки почты через SMTP

// Работа с базами данных
define('SQL_GENERAL_FILEPATH', PHP_FOLDER . '/authorization/sql_general.php'); // Общие функции запросов к базе данных

?>
