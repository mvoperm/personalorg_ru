<?php

/* МАССИВЫ С ПЕРЕЧНЕМ НАСТРОЕК ПОЛЬЗОВАТЕЛЯ */

define('USER_OPTIONS_CONSTANTS_LIST', [
  ['basic_hue', 'BASIC_HUE_TEXT', 'DEFAULT_BASIC_HUE_TEXT', ],
  ['article_transparency', 'ARTICLE_TRANSPARENCY_TEXT', 'DEFAULT_ARTICLE_TRANSPARENCY_TEXT', ],
  ['basic_font_type', 'BASIC_FONT_TYPE', 'DEFAULT_BASIC_FONT_TYPE', ],
  ['basic_font_size', 'BASIC_FONT_SIZE', 'DEFAULT_BASIC_FONT_SIZE', ],
  ['bg_image', 'BG_IMAGE', 'DEFAULT_BG_IMAGE', ],
]);
define('USER_OPTIONS_CONSTANTS_LIST_LENGTH', count(USER_OPTIONS_CONSTANTS_LIST));

define('USER_OPTIONS_GROUPS_LIST', [
  ['article_color', [USER_OPTIONS_CONSTANTS_LIST[0], USER_OPTIONS_CONSTANTS_LIST[1], ], '2', 'цветовой фон', ],
  ['basic_font', [USER_OPTIONS_CONSTANTS_LIST[2], USER_OPTIONS_CONSTANTS_LIST[3], ], '2', 'шрифт', ],
  ['bg_image', [USER_OPTIONS_CONSTANTS_LIST[4], ], '3', 'фоновый рисунок' ],
]);

?>
