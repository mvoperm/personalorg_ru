<?php
//session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);
/*
if (!$_SESSION['admin'])	{
	die(HTML_BEGINNING . '<p>Страница администратора. Сервис находится в режиме тестирования и пока не доступен для использования.</p>' . HTML_END);
}
*/
require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID, email и folder)
require_once(DOMAIN_ROOT . CONTENT_TYPES_FILEPATH); // Массивы данных о контенте (bookmarks, notes и т.п.)
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
define('TOUCH_SCREEN', $_SESSION['touchscreen_value']);

/* Проверка авторизации */
if (!USER_ID)	{
	die(HTML_BEGINNING . '<p>Для отображения содержимого данной страницы необходима авторизация.</p><p><a href="/" target="_blank">На страницу авторизации [&#8663;]</a></p>' . HTML_END);
}

/* ЗАГРУЗКА ФАЙЛА XML С ПРИМЕНЕНИЕМ ТАБЛИЦЫ СТИЛЕЙ XSLT */

// Определение контента для загрузки страницы
if (isset($_GET['content']))	{
	$correct_content = false;
	for ($i = 0; $i < CONTENT_LIST_LENGHT; $i++)	{
		if ($_GET['content'] == $contentslist[$i])	{$correct_content = true;}
	}
	$content = ($correct_content) ? htmlspecialchars($_GET['content'], ENT_QUOTES, 'UTF-8') : $contentslist[0];
} else	{
	$content = $contentslist[0];
}
if ($content != 'options')	{$_SESSION['user_content'] = $content;} // Запоминает, на какую страницу надо вернуться со страницы настроек


// Информация о переходах и номере папки, которую надо отобразить
if ($content != 'options' && isset($_SESSION['options_ascontent']))	{ // Если переходим из Настроек на страницу Пользовательского контента
	$startfolder = '0';
	unset($_SESSION['options_ascontent']);
} else if ($content == 'options' && !isset($_SESSION['options_ascontent']))	{ // Если переходим со страницы Пользовательского контента в Настройки
	$startfolder = '2';
	$_SESSION['options_ascontent'] = true;
} else if (isset($_SESSION['folder_tooppen'])) 	{
	$startfolder = $_SESSION['folder_tooppen'];
} else {
	$startfolder = ($content != 'options') ? '0' : '2';
}
unset($_SESSION['folder_tooppen']);

// Дополнительный модуль для загрузки настроек
//if ($content == 'options')	{
	require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
	get_default_options(); // Из 'SUBS_USER_OPTIONS_FILEPATH'
	define('BASIC_HUE_TEXT', (isset($_COOKIE[USER_ID . '_basic_hue']) ? $_COOKIE[USER_ID . '_basic_hue'] : DEFAULT_BASIC_HUE_TEXT));
	define('ARTICLE_TRANSPARENCY_TEXT', (isset($_COOKIE[USER_ID . '_article_transparency']) ? $_COOKIE[USER_ID . '_article_transparency'] : DEFAULT_ARTICLE_TRANSPARENCY_TEXT));
	define('BASIC_FONT_TYPE', (isset($_COOKIE[USER_ID . '_basic_font_type']) ? $_COOKIE[USER_ID . '_basic_font_type'] : DEFAULT_BASIC_FONT_TYPE));
	define('BASIC_FONT_SIZE', (isset($_COOKIE[USER_ID . '_basic_font_size']) ? $_COOKIE[USER_ID . '_basic_font_size'] : DEFAULT_BASIC_FONT_SIZE));
//}

// Установка значения константы TEST_MODE
define('TEST_MODE', isset($_SESSION['test_mode']) ? 1 : 0);

// Загрузка документа и таблицы стилей в переменные
$content_filepath = get_xml_content(USER_FOLDER, $content);
if ($content_filepath == '')	{die ('Не удалось загрузить файл с информацией.');}
$xml = new DOMDocument(); $xml -> load($content_filepath); //$xml = DOMDocument::load($content_filepath);
$xsl = new DOMDocument(); $xsl -> load('content.xsl'); //$xsl = DOMDocument::load('content.xsl');
$xslt = new XSLTProcessor();
$xslt -> importStyleSheet($xsl);

// Установка параметров для таблицы стилей
$xslt -> setParameter('', 'domain_uri', DOMAIN_URI);
$xslt -> setParameter('', 'about_filepath', ABOUT_FILEPATH);
$xslt -> setParameter('', 'user_signout_filepath', USER_SIGNOUT_FILEPATH);
$xslt -> setParameter('', 'user_id', USER_ID);
$xslt -> setParameter('', 'user_email', USER_EMAIL);
$xslt -> setParameter('', 'user_folder', USER_FOLDER);
$xslt -> setParameter('', 'touch_screen', TOUCH_SCREEN);
$xslt -> setParameter('', 'startfolder', $startfolder);
$xslt -> setParameter('', 'contentname', $content);
$xslt -> setParameter('', 'contentItemname', ${$content}[0]);
$xslt -> setParameter('', 'contentTitle', ${$content}[1]);
// Для страницы настроек не применяются
$xslt -> setParameter('', 'edit_content_filepath', EDIT_CONTENT_FILEPATH);
$xslt -> setParameter('', 'user_options_filepath', USER_OPTIONS_FILEPATH);
$xslt -> setParameter('', 'content_title_genitive', ${$content}[2]);
$xslt -> setParameter('', 'content_title_accusative', ${$content}[3]);
// Только для страницы настроек
$xslt -> setParameter('', 'change_user_email_filepath', CHANGE_USER_EMAIL_FILEPATH);
$xslt -> setParameter('', 'new_user_email', isset($_SESSION['new_user_email']) ? $_SESSION['new_user_email'] : ''); // Заплатка для устранения конфликта версий php 7.+ и 5.6. После окончания поддержки версии 5.6. необходимо заменить на строку с нуль-коалесцентным оператором: $xslt -> setParameter('', 'new_user_email', $_SESSION['new_user_email'] ?? '');
$xslt -> setParameter('', 'confirm_new_user_email_filepath', CONFIRM_NEW_USER_EMAIL_FILEPATH);
$xslt -> setParameter('', 'change_user_password_filepath', CHANGE_USER_PASSWORD_FILEPATH);
$xslt -> setParameter('', 'delete_account_filepath', DELETE_ACCOUNT_FILEPATH);
$xslt -> setParameter('', 'confirm_account_deletion_filepath', CONFIRM_ACCOUNT_DELETION_FILEPATH);
$xslt -> setParameter('', 'change_article_color_filepath', CHANGE_ARTICLE_COLOR_FILEPATH);
$xslt -> setParameter('', 'basic_hue_text', BASIC_HUE_TEXT);
$xslt -> setParameter('', 'article_transparency_text', ARTICLE_TRANSPARENCY_TEXT);
$xslt -> setParameter('', 'change_basic_font_filepath', CHANGE_BASIC_FONT_FILEPATH);
$xslt -> setParameter('', 'basic_font_type', BASIC_FONT_TYPE);
$xslt -> setParameter('', 'basic_font_size', BASIC_FONT_SIZE);
$xslt -> setParameter('', 'change_bg_image_filepath', CHANGE_BACKGROUND_IMAGE_FILEPATH);
$xslt -> setParameter('', 'images_dirpath', IMAGES_DIRPATH);
// Режим тестирования
$xslt -> setParameter('', 'toggle_test_mode_filepath', TOGGLE_TEST_MODE_FILEPATH);
$xslt -> setParameter('', 'test_mode', TEST_MODE);
$xslt -> setParameter('', 'test_screen_filepath', TEST_SCREEN_FILEPATH);

// Трансформация документа для вывода в браузер
echo $xslt -> transformToXML($xml);

?>
