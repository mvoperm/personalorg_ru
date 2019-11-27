<?php

/* Отображение контента Пользователя */
define('CONTENT_TYPES_FILEPATH', PHP_FOLDER . '/content_show/content_types.php'); // Массивы данных о контенте (bookmarks, notes и т.п.)

/* Тестовый режим */
define('TOGGLE_TEST_MODE_FILEPATH', PHP_FOLDER . '/content_show/test_mode/toggle_test_mode.php'); // Страница переключения тестового и обычного режима
define('TEST_SCREEN_FILEPATH', PHP_FOLDER . '/content_show/test_mode/tests-screen-properties.html'); // Страница переключения тестового и обычного режима

/* Данные контента из папки Пользователя */
define('HTML_CONTENT_CLASSES_FILEPATH', PHP_FOLDER . '/content_show/user_content_data/html_content_classes.php'); // Объявление классов Объектов разметки (html / xml)
define('GET_XML_CONTENT_FILEPATH', PHP_FOLDER . '/content_show/user_content_data/get_xml_content.php'); // Операции с файлами и папками контента Пользователя
define('HTML_GET_PHP_OBJECT_FILEPATH', PHP_FOLDER . '/content_show/user_content_data/get_content_php_object.php'); // Функция, возвращающая Объект контента Пользователя

/* Html-разметка */
define('HTML_GET_CONTENT_HTML_FILEPATH', PHP_FOLDER . '/content_show/contentpage_html_code/get_content_html_code.php'); // Функция, возвращающая html-код контента Пользователя
// НЕ страница с пользовательскими опциями
define('HTML_EDITMENU_FILEPATH', PHP_FOLDER . '/content_show/contentpage_html_code/html_editmenu.php'); // Код меню вызова формы редактирования контента
define('HTML_EDITFORM_FILEPATH', PHP_FOLDER . '/content_show/contentpage_html_code/html_editform.php'); // Код формы редактирования контента (элемент dialog)
define('EDIT_CONTENT_FILEPATH', PHP_FOLDER . '/content_edit/edit_content.php'); // Обработка запроса Пользователя на редактирование контента
define('USER_OPTIONS_PAGE_FILEPATH', '/content.php?content=options'); // Ссылка на страницу с настройками Пользователя в раскрывающемся меню в шапке страницы контента
// ТОЛЬКО страница с пользовательскими опциями
define('FILEPATHS_USER_OPTIONS_FILEPATH', PHP_FOLDER . '/user_options/filepaths_user_options.php'); // Константы адресов файлов с пользовательскими опциями

/* Запрос модулей */
require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID, email и folder)
require_once(DOMAIN_ROOT . CONTENT_TYPES_FILEPATH); // Массивы данных о контенте (bookmarks, notes и т.п.)

?>
