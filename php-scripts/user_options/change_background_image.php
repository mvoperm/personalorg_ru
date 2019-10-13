<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID и email)
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

$_SESSION['folder_tooppen'] = '3';

$CK_NAME = USER_ID . '_bg_image';
define('BG_IMAGE_FILE', ($_POST['delete_bg_image'] == 'on') ? '0' : htmlspecialchars($_POST['bg_image_file'], ENT_QUOTES, 'UTF-8'));

$ck_time = ($_POST['ck_bg_image'] == 'on') ? 31104000 : -86400;
$success = setcookie($CK_NAME, BG_IMAGE_FILE, time() + $ck_time, '/', DOMAIN_NAME, false);

if ($_POST['ck_bg_image'] != 'on')	{
		$success2 = set_default_options(['bg_image'], [BG_IMAGE_FILE]);
		$success = $success && $success2;
}

/*
$phrase = ($success === false) ? 'Ошибка в установке фонового рисунка.' : 'Фоновый рисунок успешно установлен.';
die(HTML_BEGINNING . '<p>' . $phrase .'</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p><p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '">Вернуться на страницу сайта</a></p>' . HTML_END);
*/

header( 'refresh:0; url = ' . DOMAIN_URI . USER_OPTIONS_FILEPATH );

?>