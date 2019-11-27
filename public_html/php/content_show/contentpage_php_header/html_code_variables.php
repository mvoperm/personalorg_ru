<?php

/* Переменные для отображения разметки html */

require_once(DOMAIN_ROOT . HTML_GET_PHP_OBJECT_FILEPATH); // Получение php-объекта данных Пользователя
if ($content !== 'options') {require_once(DOMAIN_ROOT . HTML_EDITMENU_FILEPATH);} // Меню вызова формы редактирования контента
require_once(DOMAIN_ROOT . HTML_GET_CONTENT_HTML_FILEPATH); // Отображение данных Пользователя
$user_content_html = get_user_content_html($content);
if ($content !== 'options') {
  require_once(DOMAIN_ROOT . HTML_EDITFORM_FILEPATH); // Форма редактирования контента (элемент dialog)
}

?>
