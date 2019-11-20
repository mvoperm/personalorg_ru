<?php

/* ШРИФТЫ ДЛЯ СТРАНИЦЫ НАСТРОЕК */

// Массив доступных шрифтов
define('FONT_TYPES_TOUSE', ['Arial', 'Verdana', 'Times New Roman', 'Courier New', ]);

// Код блока выбора шрифта для страницы настроек
function get_font_types_options_code() {
  $font_types_options_code = '';
  for ($i = 0; $i < count(FONT_TYPES_TOUSE); $i++) {
    $font_type_selected = (FONT_TYPES_TOUSE[$i] === USER_OPTIONS_CONSTANTS_LIST[2][1]) ? ' selected' : '';
    $font_types_options_code .= "<option{$font_type_selected} value='" . FONT_TYPES_TOUSE[$i] . "'>" . FONT_TYPES_TOUSE[$i] . "</option>";
  }
  return $font_types_options_code;
}

?>
