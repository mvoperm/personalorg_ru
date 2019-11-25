<?php

/* КОНСТАНТЫ АДРЕСОВ ПУТЕЙ К ФАЙЛАМ PHP-СКРИПТОВ БЛОКА ПОЛЬЗОВАТЕЛЬСКИХ НАСТРОЕК */

define('GET_OPTIONS_CODE_OBJECT_FILEPATH', PHP_FOLDER . '/user_options/get_options_code_object.php'); // Получение Объекта html-кода страницы настроек
define('USER_OPTIONS_CLASSES_FILEPATH', PHP_FOLDER . '/user_options/user_options_data/user_options_classes.php'); // Объявление Классов блока настроек Пользователя
define('USER_OPTIONS_LISTS_FILEPATH', PHP_FOLDER . '/user_options/user_options_data/user_options_lists.php'); // Массивы с перечнем настроек Пользователя
define('USER_OPTIONS_FONTS_CODE_FILEPATH', PHP_FOLDER . '/user_options/user_options_data/user_options_fonts_code.php'); // Перечень доступных шрифтов и код блока выбора шрифта для страницы настроек Пользователя
define('USER_OPTIONS_BGIMAGES_CODE_FILEPATH', PHP_FOLDER . '/user_options/user_options_data/user_options_bg_images_code.php'); // Перечень доступных подложек и код блока выбора подложки для страницы настроек Пользователя
define('OPTIONS_CODE_HTML_DATA_FILEPATH', PHP_FOLDER . '/user_options/user_options_data/options_code_html_data.php'); // Массивы данных с html-кодом страницы настроек Пользователя

define('IMAGES_DIRPATH', '/bg-images'); // <-> Папка с фоновыми рисунками

define('CHANGE_STYLES_OPTIONS_FILEPATH', PHP_FOLDER . '/user_options/change_styles_scripts/change_styles_options.php'); // Получение Объекта html-кода страницы настроек

define('CHANGE_USER_EMAIL_FILEPATH', PHP_FOLDER . '/user_options/change_auth_data_scripts/change_user_email.php'); // <-> Обработка запроса на изменение электронной почты Пользователя
define('CONFIRM_NEW_USER_EMAIL_FILEPATH', PHP_FOLDER . '/user_options/change_auth_data_scripts/confirm_new_user_email.php'); // <-> Подтверждение изменения электронной почты Пользователя
define('CHANGE_USER_PASSWORD_FILEPATH', PHP_FOLDER . '/user_options/change_auth_data_scripts/change_user_password.php'); // <-> Изменение пароля Пользователя
define('DELETE_ACCOUNT_FILEPATH', PHP_FOLDER . '/user_options/change_auth_data_scripts/delete_account.php'); // <-> Обработка запроса на удаление аккаунта Пользователя
define('CONFIRM_ACCOUNT_DELETION_FILEPATH', PHP_FOLDER . '/user_options/change_auth_data_scripts/confirm_account_deletion.php'); // <-> Подтверждение удаления аккаунта Пользователя


// Запрос файла получения Объекта настроек Пользователя
require_once(DOMAIN_ROOT . GET_OPTIONS_CODE_OBJECT_FILEPATH);

?>
