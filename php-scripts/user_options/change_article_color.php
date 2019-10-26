<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID и email)
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

$_SESSION['folder_tooppen'] = '2';

define('BASIC_HUE', htmlspecialchars($_POST['basic_hue'], ENT_QUOTES, 'UTF-8'));
define('ARTICLE_TRANSPARENCY', htmlspecialchars($_POST['article_transparency'], ENT_QUOTES, 'UTF-8'));

$CK1_NAME = USER_ID . '_basic_hue';
$CK2_NAME = USER_ID . '_article_transparency';


$ck_time = (isset($_POST['ck_article_color'])) ? 31104000 : -86400;
$success1 = setcookie($CK1_NAME, BASIC_HUE, time() + $ck_time, '/', DOMAIN_NAME, false);
$success2 = setcookie($CK2_NAME, ARTICLE_TRANSPARENCY, time() + $ck_time, '/', DOMAIN_NAME, false);
$success = $success1 && $success2;

if (!isset($_POST['ck_article_color']) && !isset($_POST['ck_article_color_delete']))	{
	$success3 = set_default_options(['basic_hue', 'article_transparency'], [BASIC_HUE, ARTICLE_TRANSPARENCY]);
	$success = $success && $success3;
}

if (!$success) {die('Не удалось обновить цветовой фон');}

header( 'refresh:0; url = ' . DOMAIN_URI . USER_OPTIONS_FILEPATH );

/*
$phrase = ($success === false) ? 'Ошибка в изменении цветового фона.' : 'Изменение цветового фона успешно произведено.';
echo HTML_BEGINNING . '<p>' . $phrase . '</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p><p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>' . HTML_END;
*/
?>
