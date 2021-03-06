<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов
require_once(DOMAIN_ROOT . FILEPATHS_USER_OPTIONS_FILEPATH); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов для страницы настроек
require_once(DOMAIN_ROOT . FILEPATHS_AUTH_FILEPATH); // Константы адресов файлов блока авторизации

$_SESSION['folder_tooppen'] = '1';

require_once(DOMAIN_ROOT . PW_FILEPATH);
$connection = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
require_once(DOMAIN_ROOT . SUBS_CREDENTIALS_FILEPATH);
require_once(DOMAIN_ROOT . SMTP_CONNECTION_FILEPATH);
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

$pw = $_POST['password'];
$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
$result = pw_hash_set($connection, $_SESSION['user_id'], $pw_hash);
switch ($result)	{
	case 1:
		$phrase = 'Изменение пароля прошло успешно.';
		if (isset($_POST['send_to_email']))	{
			$result_of_mail = construct_mail($_SESSION['user_email'], $_SESSION['user_id'], $pw, 'pw_change');
			// Обработать !$result_of_mail
			$phrase .= '<br>Вам направлено письмо с новым паролем.';
		}
		break;
	case 0:
		$phrase = 'Критическая ошибка при выполнении программы.<br>Изменить пароль не удалось.';
		// !!! - обработать
		break;
	default:
		$phrase = 'Критическая ошибка при выполнении программы.';
		// !!! - обработать
		break;
}
$connection -> close();

echo HTML_BEGINNING . '<p>' . $phrase . '</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_PAGE_FILEPATH . '">Вернуться на страницу настроек</a></p><p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>' . HTML_END;

?>
