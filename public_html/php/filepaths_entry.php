<?php

/* КОНСТАНТЫ АДРЕСОВ ПУТЕЙ К ФАЙЛАМ PHP-СКРИПТОВ */

// Адрес корневых каталогов
define('DOMAIN_ROOT', $_SERVER['DOCUMENT_ROOT']); // Корневой каталог домена для целей require_once ('/home/x/x926842w/x926842w.beget.tech/public_html')
define('PHP_FOLDER', '/php'); // Корневой каталог домена для целей require_once ('/home/x/x926842w/x926842w.beget.tech/public_html')
require_once(DOMAIN_ROOT . PHP_FOLDER . '/auxiliary/domain_paths.php'); // Константы наименований путей доменных имён
define('FILE_SYSTEM_FILEPATH', PHP_FOLDER . '/auxiliary/file_system.php'); // Операции с файлами и папками

// Главные файлы
define('START_AUTH_FORM_FILEPATH', '/'); // <-> Стартовая форма авторизации Пользователя в системе
define('START_CONTENT_FILEPATH', '/content.php'); // <-> Страница контента Пользователя
define('CONTENTPAGE_PHPHEADER_FILEPATH', PHP_FOLDER . '/contentpage_phpheader.php'); // Шапка страницы отображения контента Пользователя с инструкциями PHP
define('ABOUT_FILEPATH', '/about.php'); // <-> Страница с информацией о ресурсе

// Тестовый режим
define('TOGGLE_TEST_MODE_FILEPATH', PHP_FOLDER . '/auxiliary/toggle_test_mode.php'); // <-> Страница переключения тестового и обычного режима
define('TEST_SCREEN_FILEPATH', '/css/no-pack/tests-screen-properties.html'); // <-> Страница переключения тестового и обычного режима

// Авторизация
define('AUTH_FORM_HANDLING_FILEPATH', PHP_FOLDER . '/authorization/auth_form_handling.php'); // <-> Обработка данных формы авторизации Пользователя в системе
define('GET_USER_FILEPATH', PHP_FOLDER . '/authorization/get_user.php'); // Получение ID и email авторизованного Пользователя
define('USER_SIGNOUT_FILEPATH', PHP_FOLDER . '/authorization/user_signout.php'); // <-> Выход Пользователя из системы
define('SUBS_CREDENTIALS_FILEPATH', PHP_FOLDER . '/authorization/subs_credentials.php'); // Подпрограммы, связанные с проверкой и изменением авторизационных данных Пользователя
define('PW_FILEPATH', PHP_FOLDER . '/authorization/pw.php'); // Авторизационные данные. !!! Для публичных репозиториев данного кода вместо файла pw.php помещается файл pw_pseudo.php, где реальные пароли и наименования заменены на их псевдозначения

// Работа с почтой
define('SMTP_CONNECTION_FILEPATH', PHP_FOLDER . '/auxiliary/send_email.php'); // Модуль отправки почты через SMTP

// Работа с базами данных
define('SQL_GENERAL_FILEPATH', PHP_FOLDER . '/auxiliary/sql_general.php'); // Общие функции запросов к базе данных

// Фрагменты HTML-кода
define('HTML_FRAGMENTS_FILEPATH', PHP_FOLDER . '/auxiliary/html_fragments.php'); // Различные повторяющиеся HTML-конструкции, закреплённые в php-константах
define('HTML_CONTENT_CLASSES_FILEPATH', '/html-code/html_content_classes.php'); // Объявление классов Объектов разметки (html / xml)
define('HTML_GET_PHP_OBJECT_FILEPATH', '/html-code/get_content_php_object.php'); // Функция, возвращающая Объект контента Пользователя
define('HTML_GET_CONTENT_HTML_FILEPATH', '/html-code/get_content_html_code.php'); // Функция, возвращающая html-код контента Пользователя
define('HTML_EDITMENU_FILEPATH', '/html-code/html_editmenu.php'); // Код меню вызова формы редактирования контента
define('HTML_EDITFORM_FILEPATH', '/html-code/html_editform.php'); // Код формы редактирования контента (элемент dialog)

// Редактирование контента Пользователя
define('EDIT_CONTENT_FILEPATH', PHP_FOLDER . '/edit_content_scripts/edit_content.php'); // <-> Обработка запроса Пользователя на редактирование контента
define('CONTENT_TYPES_FILEPATH', PHP_FOLDER . '/edit_content_scripts/content_types.php'); // Массивы данных о контенте (bookmarks, notes и т.п.)
define('CONSTANTS_CONTENT_EDIT_FILEPATH', PHP_FOLDER . '/edit_content_scripts/constants_content_edit.php'); // Константы обработки запроса Пользователя на редактирование данных
define('SUBS_CONTENT_EDIT_FILEPATH', PHP_FOLDER . '/edit_content_scripts/subs_content_edit.php'); // Подпрограммы, связанные с редактированием контента Пользователя

// Пользовательские опции
require_once(DOMAIN_ROOT . PHP_FOLDER . '/user_options/filepaths_user_options.php'); // Константы адресов файлов с пользовательскими опциями

?>
