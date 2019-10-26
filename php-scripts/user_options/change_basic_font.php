<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID и email)
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

$_SESSION['folder_tooppen'] = '2';

define('BASIC_FONT_TYPE', htmlspecialchars($_POST['basic_font_type'], ENT_QUOTES, 'UTF-8'));
define('BASIC_FONT_SIZE', htmlspecialchars($_POST['basic_font_size'], ENT_QUOTES, 'UTF-8'));

$CK1_NAME = USER_ID . '_basic_font_type';
$CK2_NAME = USER_ID . '_basic_font_size';

$ck_time = (isset($_POST['ck_basic_font'])) ? 31104000 : -86400;
$success1 = setcookie($CK1_NAME, BASIC_FONT_TYPE, time() + $ck_time, '/', DOMAIN_NAME, false);
$success2 = setcookie($CK2_NAME, BASIC_FONT_SIZE, time() + $ck_time, '/', DOMAIN_NAME, false);
$success = $success1 && $success2;

if (!isset($_POST['ck_basic_font']) && !isset($_POST['ck_basic_font_delete']))	{
	$success3 = set_default_options(['basic_font_type', 'basic_font_size'], [BASIC_FONT_TYPE, BASIC_FONT_SIZE]);
	$success = $success && $success3;
}

if (!$success) {die('Не удалось обновить шрифт');}

header( 'refresh:0; url = ' . DOMAIN_URI . USER_OPTIONS_FILEPATH );

/*
$phrase = ($success === false) ? 'Ошибка в изменении цветового фона.' : 'Изменение цветового фона успешно произведено.';
echo HTML_BEGINNING . '<p>' . $phrase . '</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p><p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>' . HTML_END;
*/
?>
