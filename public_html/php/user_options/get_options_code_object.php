<?php

require_once(DOMAIN_ROOT . USER_OPTIONS_CLASSES_FILEPATH); // Объявление Классов блока настроек Пользователя
require_once(DOMAIN_ROOT . USER_OPTIONS_LISTS_FILEPATH); // Массивы с перечнем настроек Пользователя
require_once(DOMAIN_ROOT . USER_OPTIONS_FONTS_CODE_FILEPATH); // Перечень доступных шрифтов и код блока выбора шрифта для страницы настроек Пользователя
require_once(DOMAIN_ROOT . USER_OPTIONS_BGIMAGES_CODE_FILEPATH); // Перечень доступных подложек и код блока выбора подложки для страницы настроек Пользователя
require_once(DOMAIN_ROOT . OPTIONS_CODE_HTML_DATA_FILEPATH); // Массивы данных с html-кодом страницы настроек Пользователя


/* ФОРМИРОВАНИЕ ОБЪЕКТА HTML-КОДА СТРАНИЦЫ НАСТРОЕК ПОЛЬЗОВАТЕЛЯ */
// Данный Объект передаётся в основной код формирования страницы контента Пользователя
function get_user_options_code_object() { // Создание Объекта UserOptions (существует в единственном экземпляре)
  $user_options_code_obj = new UserOptions;
  for ($i = 0; $i < count(USER_OPTIONS_CODE_ARRAY); $i++) { // Создание Объектов UserOptionsPage и добавление их к Объекту UserOptions
    $options_page_obj = new UserOptionsPage;
    $options_page_obj -> title = USER_OPTIONS_CODE_ARRAY[$i][0];
    for ($j = 0; $j < count(USER_OPTIONS_CODE_ARRAY[$i][1]); $j++) { // Создание Объектов UserOptionsGroup и добавление их к Объекту UserOptionsPage
      $options_group_obj = new UserOptionsGroup;
      $options_group_obj -> title = USER_OPTIONS_CODE_ARRAY[$i][1][$j][0];
      $options_group_obj -> html_code = USER_OPTIONS_CODE_ARRAY[$i][1][$j][1];
      array_push($options_page_obj -> options_groups, $options_group_obj);
    }
    array_push($user_options_code_obj -> options_pages, $options_page_obj);
  }
  return $user_options_code_obj;
}


?>
