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

/* Далее к удалению до конца текущего блока PHP */
/*
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

exit();
*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>PersonalOrg.ru - <?php echo ${$content}[1]; ?></title>
	<!-- Переменные css -->
	<style id='css-variables' data-user-id='<?php echo USER_ID; ?>' data-user-folder='<?php echo USER_FOLDER; ?>'></style>
	<script type='module' src='js/css_variables.js'></script><!-- скрипт назначения переменных css -->
	<!-- Основной каскад стилей -->
	<link rel='stylesheet' href='<?php echo DOMAIN_URI . '/css/main.css'; ?>'>
	<!-- Стили для режима тестирования -->
	<!--php если $TestMode===1, то подключается следующий лист тестирования -->
	<link rel='stylesheet' href='<?php echo DOMAIN_URI . '/css/test-main.css'; ?>'>
	<!-- конец если -->
	<!-- Стили, различающиеся для сенсорных и несенсорных устройств -->
	<link rel='stylesheet' href='<?php echo DOMAIN_URI . '/css/' . TOUCH_SCREEN . '.css'; ?>'>
	<!-- Стили, задаваемые с помощью Js -->
	<style id='currentfolder-items'></style><!-- Стиль для отображения выбранной папки и скрытие остальных -->
	<style id='editform-type'></style><!-- Стиль для отображения формы соответствующего типа -->
	<style id='toggle-folderstree'></style><!-- Стиль для отображения/скрытия дерева папок -->
	<script type='module' src='js/main.js'></script><!-- Основной скрипт -->
	<!-- Специальные стили страницы настроек -->
	<?php
		if ($content === 'options')	{
			echo "
			<link rel='stylesheet' href='/css/options.css'>
			<script type='module' src='js/user_options.js'></script>
			";
		}
	?>
</head>
<body data-startfolder='$varStartFolder'>
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
							<li class='" . $listcontent_li_class . "'>
								<a href='" . DOMAIN_URI . "/content.php?content=" . $contentslist[$i] . "'>" . ${$contentslist[$i]}[1] . " контента</a>
							</li>
							";
						}
					?>
				</ul>
			</nav>
			<details class='header-menu'><!-- меню аккаунта -->
				<summary class='header-menu-summary'><!-- видимая часть меню аккаунта -->
					<?php echo USER_EMAIL . '(id' . USER_ID . ')'; ?>
				</summary>
				<nav class='header-menu-subdetails'><!-- раскрываемая часть меню аккаунта -->
					<?php
						if (USER_ID === -1)	{
							$text = (TEST_MODE === 1) ? 'Обычный режим' : 'Тестовый режим';
							echo "
							<div class='header-menu-subitem'><!-- пункт раскрываемой части меню аккаунта -->
								<form id='test-mode-form' method='post' action='" . TOGGLE_TEST_MODE_FILEPATH . "'>
									<button type='submit' name='toggle-test-mode' id='test-mode-button'>"
										. $text .
									"</button>
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
							echo "
								<p class='header-menu-subitem'><a href='" . DOMAIN_URI . USER_OPTIONS_FILEPATH . "'>
									Настройки
								</a></p>
							";
						}
					?>
					<p class='header-menu-subitem'><a target='_blank' href='<?php echo DOMAIN_URI . ABOUT_FILEPATH; ?>'>
						О сервисе [&#8663;]
					</a></p>
					<p class='header-menu-subitem'><a href='<?php echo DOMAIN_URI . USER_SIGNOUT_FILEPATH; ?>'>
						Выход
					</a></p>
				</nav>
			</details>
		</div>
	</header>
	<!-- ОСНОВНАЯ ЧАСТЬ ОКНА -->
	<main>
		<!-- (1) Дерево папок -->
		<section id='folderstree'>
			<nav>
				<details open='open'><!-- Элемент является модифицированной копией Раздела 04. для корневой папки -->
					<!--php если 'count(folder) > 0', то добавляется class='subfolders' -->
					<!-- конец если -->
					<!--php если корневая папка, то добавляется class='root-folderstree-details' -->
					<!-- конец если -->
					<summary class='folderstree-summary' data-folder-idtotal='0'><?php echo ${$content}[1]; ?></summary>
					<!-- Раздел 04. Цикл для всех папок -->
				</details>
			</nav>
		</section>
		<!-- (2) Отображаемая папка -->
		<section id='items'>
			<section class='itemsfolder' data-folder-idtotal='0'><!-- Элемент является модифицированной копией Раздела 05. для корневой папки -->
				<!-- Шапка блока items корневой папки -->
				<header>
					<div>
						<button class='toggle-folderstree-button'>&#9776;</button>
					</div>
					<div class='items-header'>
						<!-- Заголовок -->
						<h2 class='items-h2'><?php echo ${$content}[1]; ?></h2>
						<!-- Меню для редактирования -->
						<?php
							if ($content !== "options")	{
								echo "
								<details class='editmenu'>
									<summary title='Меню' class='editmenu-summary'>
										<xsl:text>&#65049;</xsl:text>
									</summary>
									<menu class='editmenu-subdetails'>
										<p class='command-button'>
											<button class='editmenu-button' data-edit-type='add' data-element-toedit-type='item'>
												Добавить" . ${$content}[3] .
											"</button>
										</p>
										<p class='command-button'><button class='editmenu-button' data-edit-type='add' data-element-toedit-type='folder'>Добавить папку</button></p>
									</menu>
								</details>
								";
							}
						?>
					</div>
				</header>
				<!-- Раздел 07. Содержание блока items корневой папки -->
			</section>
			<!-- Раздел 05. Содержание блока items для всех папок, кроме корневой -->
		</section>
		<!-- (3)Диалоговая форма для редактирования -->
		<?php
			if ($content !== "options")	{
				$uri_display_style = ($content === "bookmarks") ? "" : " style='display: none;'";
				$item_text_html = ($content === "notes") ?
					"Текст<br><textarea id='editform-item-text' name='item_text' rows='12' placeholder='Текст'></textarea>" :
					"Комментарий<br><input id='editform-item-text' name='item_text' type='text' placeholder='Текст' value=''>";
				echo "
				<dialog id='editform'>
					<form method='post' id='editform-form' action='" . EDIT_CONTENT_FILEPATH . "'>
						<!-- Служебная информация (не отображается) -->
						<p class='editform-meta'>
							<label>Тип контента
								<input id='editform-content-name' name='content_name' type='text' readonly='readonly' value='" . $content . "'>
							</label>
						</p>
						<p class='editform-meta'>
							<label>Id текущей папки
								<input id='editform-currentfolder-idtotal' name='currentfolder_idtotal' type='text' size='5' readonly='readonly' value=''>
							</label>
						</p>
						<p class='editform-meta'>
							<label>Id родителя текущего элемента
								<input id='editform-currentparent-idtotal' name='currentparent_idtotal' type='text' size='5' readonly='readonly' value=''>
							</label>
						</p>
						<p class='editform-meta'>
							<label>Id локальный
								<input id='editform-idlocal' name='item_idlocal' type='text' size='3' readonly='readonly' value=''>
							</label>
						</p>
						<p class='editform-meta'>
							<label>Элемент к редактированию
								<input id='editform-element-toedit-type' name='element_toedit_type' type='text' size='8' readonly='readonly' value=''>
							</label>
						</p>
						<p class='editform-meta'>
							<label>Тип редактирования папки / " . ${$content}[2] . "
								<input id='editform-element-edit-type' name='element_edit_type' type='text' size='8' readonly='readonly' value=''>
							</label>
						</p>
						<!-- Заголовок формы -->
						<h4 id='editform-title'></h4>
						<!-- Элементы для редактирования -->
						<p class='editform-edit'>
							<label>Заголовок<br>
								<input id='editform-element-title' name='element_title' type='text' autofocus='autofocus' placeholder='Заголовок' value='' />
							</label>
						</p>
						<p id='editform-item-par-uri' class='editform-edit'" . $uri_display_style . ">
							<label>URI закладки<br>
								<input id='editform-item-uri' name='item_uri' type='url' placeholder='https://example.com' value=''>
							</label>
						</p>
						<p id='editform-item-par-text' class='editform-edit'>
							<label>" . $item_text_html . "</label>
						</p>
						<!-- Элементы для перемещения -->
						<fieldset id='relocation-type' class='editform-relocate'>
							<legend>Тип перемещения</legend>
							<p class='checkbox-radio-par'>
								<label>
									<input id='editform-infolder-radio' name='relocation_type' type='radio' autofocus='autofocus' checked='checked' value='in_folder'>
									<span class='radio-label'> в пределах папки</span>
								</label>
							</p>
							<p class='checkbox-radio-par'>
								<label>
									<input id='editform-outfolder-radio' name='relocation_type' type='radio' value='out_folder'>
									<span class='radio-label'> в другую папку</span>
								</label>
							</p>
							<fieldset id='relocation-tree'>
								<legend>Папка для перемещения</legend>
								<ul class='root-relocation-tree-ul'>
									<li class='root-relocation-tree-li checkbox-radio-par'><!-- Элемент является модифицированной копией Раздела 07. для корневой папки -->
										<label>
											<input type='radio' name='relocation_destination_folder' checked='checked' value='0'>
											<span class='relocation-tree-li-label'>" . ${$content}[1] . "</span>
										</label>
									</li>
									<!--php если 'count(folder) > 0' -->
										<ul class='relocation-tree-ul'><!-- Раздел 06. Дерево папок для перемещения --></ul>
									<!-- конец если -->
								</ul>
							</fieldset>
						</fieldset>
						<fieldset id='relocation-order-number' class='editform-relocate-add'>
							<legend>Точка перемещения</legend>
							<p class='checkbox-radio-par'>
								<label>
									<input id='editform-firstordernumber-radio' name='relocation_order_number' type='radio' autofocus='autofocus' checked='checked' value='first' />
									<span class='radio-label'> в начало папки</span>
								</label>
							</p>
							<p class='checkbox-radio-par'>
								<label>
									<input id='editform-lastordernumber-radio' name='relocation_order_number' type='radio' value='last' />
									<span class='radio-label'> в конец папки</span>
								</label>
							</p>
							<p class='checkbox-radio-par'>
								<label>
									<input id='editform-setordernumber-radio' name='relocation_order_number' type='radio' value='set_order_number' />
									<span class='radio-label'> задать порядковый номер </span>
								</label>
								<label>
									<span style='display:none;'>порядковый номер</span>
									<input id='relocation-order-setnumber' name='relocation_order_setnumber' type='number' size='2' value='1' min='1' max='1' tabindex='-1' step='1' />
								</label>
							</p>
							<p class='maxordernumber-input'>
								<label>(максимальный порядковый номер
									<input id='editform-maxordernumber' name='relocation_maxordernumber' type='text' size='2' readonly='readonly' tabindex='-1' value=''> )
								</label>
							</p>
							<p class='editform-relocate-meta'>
								<label>Наличие папок в папке назначения:
									<input id='editform-has-folders' name='has_folders' type='text' size='5' readonly='readonly' value=''>
								</label>
							</p>
							<p class='editform-relocate-meta'>
								<label>Наличие статей в папке назначения:
									<input id='editform-has-items' name='has_items' type='text' size='5' readonly='readonly' value=''>
								</label>
							</p>
						</fieldset>
						<p class='editform-meta'>
							<label>Id (назначения) родителя
								<input id='editform-parentfolder-idtotal' name='parentfolder_idtotal' type='text' size='5' readonly='readonly' value=''>
							</label>
						</p>
						<p class='editform-meta'>
							<label>Папка (результирующая) к отображению:
								<input id='editform-folder-tooppen' name='folder_tooppen' type='text' size='5' readonly='readonly' value=''>
							</label>
						</p>
						<!-- Кнопки -->
						<p class='submit-buttons'>
							<button type='submit' id='submit'>OK</button>
							<button type='button' id='cancel'>Отмена</button>
						</p>
					</form>
				</dialog>
				";
			}
		?>
	</main>
	<!-- ПОДВАЛ ОКНА -->
	<footer>
		<address>PersonalOrg.ru 2019, <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a></address>
	</footer>
</body>
</html>
