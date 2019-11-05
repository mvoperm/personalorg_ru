<?php

/* ШАПКА СТРАНИЦЫ ОТОБРАЖЕНИЯ КОНТЕНТА С ИНСТРУКЦИЯМИ PHP */

require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH); // Начало и окончание страницы для рабочих объявлений
/*
if (!$_SESSION['admin'])	{
	die(HTML_BEGINNING . '<p>Страница администратора. Сервис находится в режиме тестирования и пока не доступен для использования.</p>' . HTML_END);
}
*/

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID, email и folder)
require_once(DOMAIN_ROOT . CONTENT_TYPES_FILEPATH); // Массивы данных о контенте (bookmarks, notes и т.п.)
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
define('TOUCH_SCREEN', $_SESSION['touchscreen_value']); // Выбор сенсорного / несенсорного режима работы

/* Проверка авторизации */
if (!USER_ID)	{
	die(HTML_BEGINNING . '<p>Для отображения содержимого данной страницы необходима авторизация.</p><p><a href="/" target="_blank">На страницу авторизации [&#8663;]</a></p>' . HTML_END);
}

// Определение контента для загрузки страницы
if (isset($_GET['content']))	{
	$correct_content = false;
	for ($i = 0; $i < CONTENT_LIST_LENGHT; $i++)	{
		if ($_GET['content'] === $contentslist[$i])	{$correct_content = true;}
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
if ($content === 'options')	{
	require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
	get_default_options(); // Из 'SUBS_USER_OPTIONS_FILEPATH'
	define('BASIC_HUE_TEXT', (isset($_COOKIE[USER_ID . '_basic_hue']) ? $_COOKIE[USER_ID . '_basic_hue'] : DEFAULT_BASIC_HUE_TEXT));
	define('ARTICLE_TRANSPARENCY_TEXT', (isset($_COOKIE[USER_ID . '_article_transparency']) ? $_COOKIE[USER_ID . '_article_transparency'] : DEFAULT_ARTICLE_TRANSPARENCY_TEXT));
	define('BASIC_FONT_TYPE', (isset($_COOKIE[USER_ID . '_basic_font_type']) ? $_COOKIE[USER_ID . '_basic_font_type'] : DEFAULT_BASIC_FONT_TYPE));
	define('BASIC_FONT_SIZE', (isset($_COOKIE[USER_ID . '_basic_font_size']) ? $_COOKIE[USER_ID . '_basic_font_size'] : DEFAULT_BASIC_FONT_SIZE));
}

// Установка значения константы TEST_MODE
define('TEST_MODE', isset($_SESSION['test_mode']) ? 1 : 0);

/* Переменные для отображения разметки html */
require_once(DOMAIN_ROOT . HTML_GET_PHP_OBJECT_FILEPATH); // Получение php-объекта данных Пользователя
require_once(DOMAIN_ROOT . HTML_EDITMENU_FILEPATH); // Меню вызова формы редактирования контента
require_once(DOMAIN_ROOT . HTML_GET_CONTENT_HTML_FILEPATH); // Отображение данных Пользователя
$user_content_html = get_user_content_html($content);
require_once(DOMAIN_ROOT . HTML_EDITFORM_FILEPATH); // Форма редактирования контента (элемент dialog)

$optionspage_scripts = ($content !== 'options') ? '' : "<script type='module' src='js/user_options.js'></script>"; // Переменная для отображения скриптов страницы настроек

// Перечень доступных сервисов
$contents_list_code = '';
for ($i = 0; $i < (CONTENT_LIST_LENGHT - 1); $i++) {
  $contents_list_li_class = ($contentslist[$i] === $content) ? "header-contents-list-li header-contents-list-li-current" : "header-contents-list-li";
  $contents_list_code .= "
  <li class='{$contents_list_li_class}'>
    <a href='" . DOMAIN_URI . "/content.php?content={$contentslist[$i]}'>{${$contentslist[$i]}[1]}</a>
  </li>
  ";
}

$test_mode_code = ''; // В случае активизации режима тестирования в следующем блоке происходит присвоение данной переменной строки кода, который будет внедрён на странице
if (USER_ID === '-1')	{
  $text_testmode_button = (TEST_MODE === 1) ? 'Обычный режим' : 'Тестовый режим';
  $test_mode_code = "
  <div class='header-menu-subitem'><!-- пункт раскрываемой части меню аккаунта -->
    <form id='test-mode-form' method='post' action='" . TOGGLE_TEST_MODE_FILEPATH . "'>
      <button type='submit' name='toggle-test-mode' id='test-mode-button'>{$text_testmode_button}</button>
    </form>
  </div>
  <p class='header-menu-subitem test-mode'><a target='_blank' href='" . DOMAIN_URI . TEST_SCREEN_FILEPATH . "'>
    Свойства экрана [&#8663;]
  </a></p>
  ";
} // Код для режима тестирования

$options_header_menu_subitem = ($content === 'options')	? '' : "<p class='header-menu-subitem'><a href='" . DOMAIN_URI . USER_OPTIONS_FILEPATH . "'>Настройки</a></p>"; // Отображение строки Настройки в ниспадающем меню Шапки страницы - в листе Настроек не отображается

?>
