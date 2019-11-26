<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов

// Определение констант адресов файлов блока отображения контента и запрос соответствующих модулей
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/filepaths_content_show.php');
// Выбор сенсорного / несенсорного режима работы
define('TOUCH_SCREEN', $_SESSION['touchscreen_value']);
// Проверка авторизации
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/content_php_header/authorization_check.php');
// Определение контента для загрузки страницы
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/content_php_header/content_type_toshow.php');
// Информация о переходах и номере папки, которую надо отобразить
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/content_php_header/folder_toopen_assignment.php');
// Дополнительный модуль для загрузки настроек (константы адресов файлов с пользовательскими опциями и соответствующие запросы)
if ($content === 'options')	{require_once(DOMAIN_ROOT . FILEPATHS_USER_OPTIONS_FILEPATH);}
// Отображение перечня доступных сервисов
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/content_php_header/contentlist_code.php');
// Режим тестирования
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/content_php_header/test_mode_code.php');
// Отображение строки Настройки в ниспадающем меню Шапки страницы - в листе Настроек не отображается
$options_header_menu_subitem = ($content === 'options') ? '' : "<p class='header-menu-subitem'><a href='" . DOMAIN_URI . USER_OPTIONS_PAGE_FILEPATH . "'>Настройки</a></p>";
// Переменные для отображения разметки html
require_once(DOMAIN_ROOT . PHP_FOLDER . '/content_show/content_php_header/html_code_variables.php');

?>

<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>PersonalOrg.ru - <?= ${$content}[1]; ?></title>
	<!-- Переменные css -->
	<style id='css-variables' data-user-id='<?= USER_ID; ?>' data-user-folder='<?= USER_FOLDER; ?>'></style>
	<link rel='stylesheet' href='/css/content.css'>
	<?php	// Стили для режима тестирования
		if (TEST_MODE === 1)	{echo "<link rel='stylesheet' href='/css/no-pack/test-main.css'>";}
	?>
	<?php if (TOUCH_SCREEN === 'no-sensor') { echo "<link rel='stylesheet' href='/css/no-pack/no-sensor.css'>"; }  /* Специальные стили для несенсорных устройств */ ?>
	<!-- Стили, задаваемые с помощью Js -->
	<style id='currentfolder-items'></style><!-- Стиль для отображения выбранной папки и скрытия остальных -->
	<style id='editform-type'></style><!-- Стиль для отображения формы соответствующего типа -->
	<script type='module' src='js/content.js'></script>
</head>
<body data-startfolder='<?= $startfolder; ?>'>
	<!-- ШАПКА ОКНА -->
	<header class='body-header'>
		<h1 class='page-title'>Персональный онлайн-органайзер</h1>
		<div id='headermenu' class='flex-line-basic flex-line-wrap-reverse'><!-- меню шапки -->
			<nav class='flex-line-grow-el'><!-- перечень видов контента -->
				<ul class='header-contents-list-ul'>
					<?= $contents_list_code; ?>
				</ul>
			</nav>
			<details class='header-menu'><!-- меню аккаунта -->
				<summary class='header-menu-summary'><!-- видимая часть меню аккаунта -->
					<?= USER_EMAIL . ' (id = ' . USER_ID . ')'; ?>
				</summary>
				<nav class='header-menu-subdetails'><!-- раскрываемая часть меню аккаунта -->
					<?= $test_mode_code; ?><!-- в случае активизации режима тестирования данный код будет внедрён на странице -->
					<?= $options_header_menu_subitem; ?><!-- отображение строки Настройки в ниспадающем меню Шапки страницы - в листе Настроек не отображается -->
					<p class='header-menu-subitem'><a target='_blank' href='<?= DOMAIN_URI . ABOUT_FILEPATH; ?>'>О сервисе [&#8663;]</a></p>
					<p class='header-menu-subitem'><a href='<?= DOMAIN_URI . START_AUTH_FORM_FILEPATH; ?>'>Выход</a></p>
				</nav>
			</details>
		</div>
	</header>
	<!-- ОСНОВНАЯ ЧАСТЬ ОКНА -->
	<main>
		<!-- (1) Дерево папок -->
		<section id='folderstree'>
			<nav><?= $user_content_html[0]; ?></nav>
		</section>
		<!-- (2) Отображаемая папка -->
		<section id='items'><?= $user_content_html[1]; ?></section>
		<!-- (3) Диалоговая форма для редактирования. Для страницы настроек не загружается -->
		<?php if ($content !== 'options') {echo $html_editform;} ?>
	</main>
	<!-- ПОДВАЛ ОКНА -->
	<footer>
		<address>PersonalOrg.ru 2019, <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a></address>
	</footer>
</body>
</html>
