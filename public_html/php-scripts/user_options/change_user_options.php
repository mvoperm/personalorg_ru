<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID и email)
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

require_once(DOMAIN_ROOT . USER_OPTIONS_LISTS_FILEPATH); // Массивы с перечнем настроек Пользователя

function change_user_options($option_number_string) {
  $option_number = (integer) ($option_number_string);

  // Папка к отображению после изменения настройки
  $_SESSION['folder_tooppen'] = USER_OPTIONS_GROUPS_LIST[$option_number][2];

  // Проверка и задание времени для установку / удаление куки
  $ck_title = 'ck_' . USER_OPTIONS_GROUPS_LIST[$option_number][0];
  $ck_title_delete = $ck_title . '_delete';
  $ck_time = (isset($_POST[$ck_title])) ? 31104000 : -86400;

  // Установка / удаление куки
  $options_array = USER_OPTIONS_GROUPS_LIST[$option_number][1];
  $ck_name = [];
  $success_array = [];
  $success = true;
  for ($i = 0; $i < count($options_array); $i++) {
    define($options_array[$i][1], htmlspecialchars($_POST[$options_array[$i][0]], ENT_QUOTES, 'UTF-8'));
    array_push($ck_name, USER_ID . '_' . $options_array[$i][0]);
    $success_array[$i] = setcookie($ck_name[$i], constant($options_array[$i][1]), time() + $ck_time, '/', DOMAIN_NAME, false);
    $success = $success && $success_array[$i];
  }

  // Установка значений по умолчанию для всех устройств
  if (!isset($_POST[$ck_title]) && !isset($_POST[$ck_title_delete]))	{
    $default_options_keys = [];
    $default_options_values = [];
    for ($i = 0; $i < count($options_array); $i++) {
      array_push($default_options_keys, $options_array[$i][0]);
      array_push($default_options_values, $options_array[$i][1]);
    }
    $success2 = set_default_options($default_options_keys, $default_options_values);
  	$success = $success && $success2;
  }
  if (!$success) {echo 'Не удалось обновить ' . USER_OPTIONS_GROUPS_LIST[$option_number][3]; exit();}

  header( 'refresh:0; url = ' . DOMAIN_URI . USER_OPTIONS_PAGE_FILEPATH );

  /*
  $phrase = ($success === false) ? 'Ошибка в изменении цветового фона.' : 'Изменение цветового фона успешно произведено.';
  echo HTML_BEGINNING . '<p>' . $phrase . '</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p><p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>' . HTML_END;
  */
}

change_user_options($_POST['option_number']);

?>
