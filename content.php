<?php

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

/* ЗАГРУЗКА ФАЙЛА XML */

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

$xml = new DOMDocument(); $xml -> load($content_filepath);


/* Переменные для отображения разметки html */
/* temp */ //require_once(DOMAIN_ROOT . '/html-code/xslt_params.php'); // Временный файл для хранения кода присвоения параметров XSLT
require_once(DOMAIN_ROOT . HTML_OPTIONS_CODES_FILEPATH); // Коды для страницы настроек
require_once(DOMAIN_ROOT . HTML_GET_PHP_OBJECT_FILEPATH); // Отображение данных Пользователя
require_once(DOMAIN_ROOT . HTML_GET_CONTENT_HTML_FILEPATH); // Отображение данных Пользователя
require_once(DOMAIN_ROOT . HTML_EDITFORM_FILEPATH); // Форма редактирования контента (элемент dialog)

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>PersonalOrg.ru - <?= ${$content}[1]; ?></title>
	<!-- Переменные css -->
	<style id='css-variables' data-user-id='<?= USER_ID; ?>' data-user-folder='<?= USER_FOLDER; ?>'></style>
	<script type='module' src='js/css_variables.js'></script>
	<!-- Основной каскад стилей -->
	<link rel='stylesheet' href='<?= DOMAIN_URI . '/css/main.css'; ?>'>
	<?php	// Стили для режима тестирования
		if (TEST_MODE === 1)	{echo "<link rel='stylesheet' href='" . DOMAIN_URI . "/css/test-main.css'>";}
	?>
	<!-- Стили, различающиеся для сенсорных и несенсорных устройств -->
	<link rel='stylesheet' href='<?= DOMAIN_URI . '/css/' . TOUCH_SCREEN . '.css'; ?>'>
	<!-- Стили, задаваемые с помощью Js -->
	<style id='currentfolder-items'></style><!-- Стиль для отображения выбранной папки и скрытие остальных -->
	<style id='editform-type'></style><!-- Стиль для отображения формы соответствующего типа -->
	<style id='toggle-folderstree'></style><!-- Стиль для отображения/скрытия дерева папок -->
	<script type='module' src='js/main.js'></script><!-- Основной скрипт -->
	<?php // Специальные стили страницы настроек
		if ($content === 'options')	{
			echo <<<EOT
			<link rel='stylesheet' href='/css/options.css'>
			<script type='module' src='js/user_options.js'></script>
EOT;
		}
	?>
</head>
<body data-startfolder='<?= $startfolder; ?>'>
	<!-- ШАПКА ОКНА -->
	<header class='body-header'>
		<h1>Персональный онлайн-органайзер</h1>
		<div id='headermenu'><!-- меню шапки -->
			<nav><!-- перечень сервисов -->
				<ul class='header-listcontent-ul'>
					<?php
						for ($i = 0; $i < (CONTENT_LIST_LENGHT - 1); $i++) {
							$listcontent_li_class = ($contentslist[$i] === $content) ? "header-listcontent-li header-listcontent-li-current" : "header-listcontent-li";
							echo "
							<li class='{$listcontent_li_class}'>
								<a href='" . DOMAIN_URI . "/content.php?content={$contentslist[$i]}'>{${$contentslist[$i]}[1]}</a>
							</li>
							";
						}
					?>
				</ul>
			</nav>
			<details class='header-menu'><!-- меню аккаунта -->
				<summary class='header-menu-summary'><!-- видимая часть меню аккаунта -->
					<?= USER_EMAIL . ' (id = ' . USER_ID . ')'; ?>
				</summary>
				<nav class='header-menu-subdetails'><!-- раскрываемая часть меню аккаунта -->
					<?php
						if (USER_ID === '-1')	{
							$text = (TEST_MODE === 1) ? 'Обычный режим' : 'Тестовый режим';
							echo "
							<div class='header-menu-subitem'><!-- пункт раскрываемой части меню аккаунта -->
								<form id='test-mode-form' method='post' action='" . TOGGLE_TEST_MODE_FILEPATH . "'>
									<button type='submit' name='toggle-test-mode' id='test-mode-button'>{$text}</button>
								</form>
							</div>
							<p class='header-menu-subitem test-mode'><a target='_blank' href='" . DOMAIN_URI . TEST_SCREEN_FILEPATH . "'>
								Свойства экрана [&#8663;]
							</a></p>
							";
						}
					?>
					<?php
						if ($content !== "options")	{
							echo "<p class='header-menu-subitem'><a href='" . DOMAIN_URI . USER_OPTIONS_FILEPATH . "'>Настройки</a></p>";
						}
					?>
					<p class='header-menu-subitem'><a target='_blank' href='<?= DOMAIN_URI . ABOUT_FILEPATH; ?>'>О сервисе [&#8663;]</a></p>
					<p class='header-menu-subitem'><a href='<?= DOMAIN_URI . USER_SIGNOUT_FILEPATH; ?>'>Выход</a></p>
				</nav>
			</details>
		</div>
	</header>
	<!-- ОСНОВНАЯ ЧАСТЬ ОКНА -->
	<main>
		<!-- (1) Дерево папок -->
		<section id='folderstree'>
			<nav><?= $folderstree_html; ?></nav>
		</section>
		<!-- (2) Отображаемая папка -->
		<section id='items'><?= $items_html; ?></section>
		<!-- (3)Диалоговая форма для редактирования -->
		<?php
			if ($content !== "options")	{
				echo HTML_EDITFORM;
			}
		?>
	</main>
	<!-- ПОДВАЛ ОКНА -->
	<footer>
		<address>PersonalOrg.ru 2019, <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a></address>
	</footer>
</body>
</html>
