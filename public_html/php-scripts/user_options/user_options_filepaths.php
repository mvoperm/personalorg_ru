<?php

/* КОНСТАНТЫ АДРЕСОВ ПУТЕЙ К ФАЙЛАМ PHP-СКРИПТОВ БЛОКА ПОЛЬЗОВАТЕЛЬСКИХ НАСТРОЕК */

define('USER_OPTIONS_PAGE_FILEPATH', '/content.php?content=options'); // <-> Страница с настройками Пользователя
define('SUBS_USER_OPTIONS_FILEPATH', '/php-scripts/user_options/subs_user_options.php'); // Подпрограммы, связанные с получением и изменением настроек Пользователя
define('CHANGE_USER_EMAIL_FILEPATH', '/php-scripts/user_options/form_action_scripts/change_user_email.php'); // <-> Обработка запроса на изменение электронной почты Пользователя
define('CONFIRM_NEW_USER_EMAIL_FILEPATH', '/php-scripts/user_options/form_action_scripts/confirm_new_user_email.php'); // <-> Подтверждение изменения электронной почты Пользователя
define('CHANGE_USER_PASSWORD_FILEPATH', '/php-scripts/user_options/form_action_scripts/change_user_password.php'); // <-> Изменение пароля Пользователя
define('DELETE_ACCOUNT_FILEPATH', '/php-scripts/user_options/form_action_scripts/delete_account.php'); // <-> Обработка запроса на удаление аккаунта Пользователя
define('CONFIRM_ACCOUNT_DELETION_FILEPATH', '/php-scripts/user_options/form_action_scripts/confirm_account_deletion.php'); // <-> Подтверждение удаления аккаунта Пользователя
define('CHANGE_ARTICLE_COLOR_FILEPATH', '/php-scripts/user_options/form_action_scripts/change_article_color.php'); // <-> Изменение цветового фона статьи
define('CHANGE_BASIC_FONT_FILEPATH', '/php-scripts/user_options/form_action_scripts/change_basic_font.php'); // <-> Изменение цветового фона статьи
define('CHANGE_BACKGROUND_IMAGE_FILEPATH', '/php-scripts/user_options/form_action_scripts/change_background_image.php'); // <-> Изменение фонового рисунка
define('CHANGE_USER_OPTIONS_FILEPATH', '/php-scripts/user_options/change_user_options.php'); // <-> !!! Заготовка для НОВОГО блока управления настройками Пользователя

?>
