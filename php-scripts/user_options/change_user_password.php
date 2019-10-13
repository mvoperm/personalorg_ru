<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

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
		if ($_POST['send_to_email'] == 'on')	{
			$result_of_mail = construct_mail($_SESSION['user_email'], $_SESSION['user_id'], $pw, 'pw_change');
			// Обработать !$result_of_mail
			$phrase .= '<br />Вам направлено письмо с новым паролем.';
		}
		break;
	case 0:
		$phrase = 'Критическая ошибка при выполнении программы.<br />Изменить пароль не удалось.<br />Администратору ресурса отправлено письмо о данной ошибке.';
		// !!! - обработать
		break;
	default:
		$phrase = 'Критическая ошибка при выполнении программы.<br />Администратору ресурса отправлено письмо о данной ошибке.';
		// !!! - обработать
		break;
}
$connection -> close();

echo HTML_BEGINNING . '<p>' . $phrase . '</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p><p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>' . HTML_END;

?>