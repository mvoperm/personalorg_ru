<?php

/* КОНСТАНТЫ АДРЕСОВ ПУТЕЙ К РАЗЛИЧНЫМ ФАЙЛАМ */

// Адрес корневых каталогов
define('DOMAIN_ROOT', $_SERVER['DOCUMENT_ROOT']); // Корневой каталог домена для целей require_once ('/home/x/x926842w/x926842w.beget.tech/public_html')
define('PHP_FOLDER', '/php'); // Корневой каталог домена для целей require_once ('/home/x/x926842w/x926842w.beget.tech/public_html')
require_once(DOMAIN_ROOT . PHP_FOLDER . '/general/domain_paths.php'); // Константы наименований путей доменных имён

// Главные файлы
define('START_AUTH_FORM_FILEPATH', '/'); // <-> Стартовая форма авторизации Пользователя в системе
define('START_CONTENT_FILEPATH', '/content.php'); // <-> Страница контента Пользователя
define('ABOUT_FILEPATH', '/about.php'); // <-> Страница с информацией о ресурсе
define('AUTH_FORM_HANDLING_FILEPATH', PHP_FOLDER . '/authorization/auth_form_handling.php'); // <-> Обработка данных формы авторизации Пользователя в системе
// Вспомогательные файлы для разных страниц
define('GET_USER_FILEPATH', PHP_FOLDER . '/general/get_user.php'); // Получение ID и email авторизованного Пользователя
define('HTML_FRAGMENTS_FILEPATH', PHP_FOLDER . '/general/html_fragments.php'); // Различные повторяющиеся HTML-конструкции, закреплённые в php-константах
define('USERS_DIR', SERVER_ROOT . '/users/'); // Папка с данным Пользователей
// ТОЛЬКО страница с пользовательскими опциями
define('FILEPATHS_USER_OPTIONS_FILEPATH', PHP_FOLDER . '/user_options/filepaths_user_options.php'); // Константы адресов файлов с пользовательскими опциями
define('USER_OPTIONS_PAGE_FILEPATH', '/content.php?content=options'); // Ссылка на страницу с настройками Пользователя в раскрывающемся меню в шапке страницы контента

?>
