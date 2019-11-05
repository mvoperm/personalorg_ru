<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов
require_once(DOMAIN_ROOT . CONTENTPAGE_PHPHEADER_FILEPATH); // Шапка страницы отображения контента Пользователя с инструкциями PHP

?>

<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>PersonalOrg.ru - <?= ${$content}[1]; ?></title>
	<!-- Переменные css -->
	<style id='css-variables' data-user-id='<?= USER_ID; ?>' data-user-folder='<?= USER_FOLDER; ?>'></style>
	<script type='module' src='js/css_variables.js'></script>
	<link rel='stylesheet' href='<?= '/css/main.css'; ?>'><!-- Основной каскад стилей -->
	<?php	// Стили для режима тестирования
		if (TEST_MODE === 1)	{echo "<link rel='stylesheet' href='/css/test-main.css'>";}
	?>
	<link rel='stylesheet' href='/css/sensor.css'>
	<?php if (TOUCH_SCREEN === 'no-sensor') { echo "<link rel='stylesheet' href='/css/no-sensor.css'>"; }  /* Специальные стили для несенсорных устройств */ ?>
	<!-- Стили, задаваемые с помощью Js -->
	<style id='currentfolder-items'></style><!-- Стиль для отображения выбранной папки и скрытие остальных -->
	<style id='editform-type'></style><!-- Стиль для отображения формы соответствующего типа -->
	<script type='module' src='js/main.js'></script><!-- Основной скрипт -->
	<?= $optionspage_scripts; // Специальные скрипты страницы настроек ?>
</head>
<body data-startfolder='<?= $startfolder; ?>'>
	<!-- ШАПКА ОКНА -->
	<header class='body-header'>
		<h1>Персональный онлайн-органайзер</h1>
		<div id='headermenu'><!-- меню шапки -->
			<nav><!-- перечень видов контента -->
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
					<p class='header-menu-subitem'><a href='<?= DOMAIN_URI . USER_SIGNOUT_FILEPATH; ?>'>Выход</a></p>
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
		<?= $html_editform; ?>
	</main>
	<!-- ПОДВАЛ ОКНА -->
	<footer>
		<address>PersonalOrg.ru 2019, <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a></address>
	</footer>
</body>
</html>
