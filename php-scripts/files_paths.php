<?php

/* КОНСТАНТЫ АДРЕСОВ ПУТЕЙ К ФАЙЛАМ PHP-СКРИПТОВ */

// Адрес корневых каталогов
define('DOMAIN_ROOT', $_SERVER['DOCUMENT_ROOT']); // Корневой каталог домена для целей require_once ('/home/x/x926842w/x926842w.beget.tech/public_html')
require_once(DOMAIN_ROOT . '/php-scripts/auxiliary/domain_paths.php'); // Константы наименований путей доменных имён
define('FILE_SYSTEM_FILEPATH', '/php-scripts/auxiliary/file_system.php'); // Операции с файлами и папками

// Главные файлы
define('START_AUTH_FORM_FILEPATH', '/'); // <-> Стартовая форма авторизации Пользователя в системе
define('START_CONTENT_FILEPATH', '/content.php'); // <-> Страница контента Пользователя
define('CONTENTPAGE_PHPHEADER_FILEPATH', '/php-scripts/contentpage_phpheader.php'); // Шапка страницы отображения контента Пользователя с инструкциями PHP
define('ABOUT_FILEPATH', '/about.php'); // <-> Страница с информацией о ресурсе

// Тестовый режим
define('TOGGLE_TEST_MODE_FILEPATH', '/php-scripts/test_mode/toggle_test_mode.php'); // <-> Страница переключения тестового и обычного режима
define('TEST_SCREEN_FILEPATH', '/css/tests-screen-properties.html'); // <-> Страница переключения тестового и обычного режима

// Авторизация
define('AUTH_FORM_HANDLING_FILEPATH', '/php-scripts/authorization/auth_form_handling.php'); // <-> Обработка данных формы авторизации Пользователя в системе
define('GET_USER_FILEPATH', '/php-scripts/authorization/get_user.php'); // Получение ID и email авторизованного Пользователя
define('USER_SIGNOUT_FILEPATH', '/php-scripts/authorization/user_signout.php'); // <-> Выход Пользователя из системы
define('SUBS_CREDENTIALS_FILEPATH', '/php-scripts/authorization/subs_credentials.php'); // Подпрограммы, связанные с проверкой и изменением авторизационных данных Пользователя
define('PW_FILEPATH', '/php-scripts/authorization/pw.php'); // Авторизационные данные. !!! Для публичных репозиториев данного кода вместо файла pw.php помещается файл pw_pseudo.php, где реальные пароли и наименования заменены на их псевдозначения

// Работа с почтой
define('SMTP_CONNECTION_FILEPATH', '/php-scripts/auxiliary/send_email.php'); // Модуль отправки почты через SMTP

// Работа с базами данных
define('SQL_GENERAL_FILEPATH', '/php-scripts/auxiliary/sql_general.php'); // Общие функции запросов к базе данных

// Графические файлы
define('IMAGES_DIRPATH', '/bg-images'); // <->? Папка с картинками

// Фрагменты HTML-кода
define('HTML_FRAGMENTS_FILEPATH', '/php-scripts/auxiliary/html_fragments.php'); // Различные повторяющиеся HTML-конструкции, закреплённые в php-константах
define('HTML_CLASSES_FILEPATH', '/html-code/html_classes.php'); // Объявление классов Объектов разметки (html / xml)
define('HTML_GET_PHP_OBJECT_FILEPATH', '/html-code/get_content_php_object.php'); // Функция, возвращающая Объект контента Пользователя
define('HTML_GET_CONTENT_HTML_FILEPATH', '/html-code/get_content_html_code.php'); // Функция, возвращающая html-код контента Пользователя
define('HTML_EDITMENU_FILEPATH', '/html-code/html_editmenu.php'); // Код меню вызова формы редактирования контента
define('HTML_EDITFORM_FILEPATH', '/html-code/html_editform.php'); // Код формы редактирования контента (элемент dialog)
define('HTML_OPTIONS_CODES_FILEPATH', '/html-code/options_codes.php'); // Коды для страницы настроек. Вызываются из функции получения html-кода

// Редактирование контента Пользователя
define('EDIT_CONTENT_FILEPATH', '/php-scripts/user_content/edit_content.php'); // <-> Обработка запроса Пользователя на редактирование контента
define('CONTENT_TYPES_FILEPATH', '/php-scripts/user_content/content_types.php'); // Массивы данных о контенте (bookmarks, notes и т.п.)
define('CONSTANTS_CONTENT_EDIT_FILEPATH', '/php-scripts/user_content/constants_content_edit.php'); // Константы обработки запроса Пользователя на редактирование данных
define('SUBS_CONTENT_EDIT_FILEPATH', '/php-scripts/user_content/subs_content_edit.php'); // Подпрограммы, связанные с редактированием контента Пользователя

// Пользовательские опции
define('USER_OPTIONS_FILEPATH', '/content.php?content=options'); // <-> Страница с настройками Пользователя
define('SUBS_USER_OPTIONS_FILEPATH', '/php-scripts/user_options/subs_user_options.php'); // Подпрограммы, связанные с получением и изменением настроек Пользователя
define('CHANGE_USER_EMAIL_FILEPATH', '/php-scripts/user_options/change_user_email.php'); // <-> Обработка запроса на изменение электронной почты Пользователя
define('CONFIRM_NEW_USER_EMAIL_FILEPATH', '/php-scripts/user_options/confirm_new_user_email.php'); // <-> Подтверждение изменения электронной почты Пользователя
define('CHANGE_USER_PASSWORD_FILEPATH', '/php-scripts/user_options/change_user_password.php'); // <-> Изменение пароля Пользователя
define('DELETE_ACCOUNT_FILEPATH', '/php-scripts/user_options/delete_account.php'); // <-> Обработка запроса на удаление аккаунта Пользователя
define('CONFIRM_ACCOUNT_DELETION_FILEPATH', '/php-scripts/user_options/confirm_account_deletion.php'); // <-> Подтверждение удаления аккаунта Пользователя
define('CHANGE_ARTICLE_COLOR_FILEPATH', '/php-scripts/user_options/change_article_color.php'); // <-> Изменение цветового фона статьи
define('CHANGE_BASIC_FONT_FILEPATH', '/php-scripts/user_options/change_basic_font.php'); // <-> Изменение цветового фона статьи
define('CHANGE_BACKGROUND_IMAGE_FILEPATH', '/php-scripts/user_options/change_background_image.php'); // <-> Изменение фонового рисунка

?>
