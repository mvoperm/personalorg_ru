<?php

// Отображение контента Пользователя
define('CONTENT_TYPES_FILEPATH', PHP_FOLDER . '/content_show/content_types.php'); // Массивы данных о контенте (bookmarks, notes и т.п.)
define('USER_OPTIONS_PAGE_FILEPATH', '/content.php?content=options'); // Страница с настройками Пользователя
define('TOGGLE_TEST_MODE_FILEPATH', PHP_FOLDER . '/content_show/toggle_test_mode.php'); // Страница переключения тестового и обычного режима
define('TEST_SCREEN_FILEPATH', '/css/no-pack/tests-screen-properties.html'); // Страница переключения тестового и обычного режима
define('HTML_CONTENT_CLASSES_FILEPATH', PHP_FOLDER . '/content_show/html_content_classes.php'); // Объявление классов Объектов разметки (html / xml)
define('HTML_GET_PHP_OBJECT_FILEPATH', PHP_FOLDER . '/content_show/get_content_php_object.php'); // Функция, возвращающая Объект контента Пользователя
define('HTML_GET_CONTENT_HTML_FILEPATH', PHP_FOLDER . '/content_show/get_content_html_code.php'); // Функция, возвращающая html-код контента Пользователя
// НЕ Пользовательские опции
define('HTML_EDITMENU_FILEPATH', PHP_FOLDER . '/content_show/html_editmenu.php'); // Код меню вызова формы редактирования контента
define('HTML_EDITFORM_FILEPATH', PHP_FOLDER . '/content_show/html_editform.php'); // Код формы редактирования контента (элемент dialog)
define('EDIT_CONTENT_FILEPATH', PHP_FOLDER . '/content_edit/edit_content.php'); // Обработка запроса Пользователя на редактирование контента
// ТОЛЬКО Пользовательские опции
define('FILEPATHS_USER_OPTIONS_FILEPATH', PHP_FOLDER . '/user_options/filepaths_user_options.php'); // Константы адресов файлов с пользовательскими опциями
define('GET_XML_CONTENT_FILEPATH', PHP_FOLDER . '/content_show/get_xml_content.php'); // Операции с файлами и папками контента Пользователя

// Запрос модулей
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH); // Начало и окончание страницы для рабочих объявлений
require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID, email и folder)
require_once(DOMAIN_ROOT . CONTENT_TYPES_FILEPATH); // Массивы данных о контенте (bookmarks, notes и т.п.)
require_once(DOMAIN_ROOT . GET_XML_CONTENT_FILEPATH); // Операции с файлами и папками

?>
