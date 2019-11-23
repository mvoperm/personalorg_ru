<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

$_SESSION['folder_tooppen'] = '1';

$result = password_verify($_POST['pw_toconfirm_email'], $_SESSION['pwhash_email_tochange']) ? 1 : 0;
unset($_SESSION['pwhash_email_tochange']);
switch ($result)	{
	case 1:
		require_once(DOMAIN_ROOT . PW_FILEPATH);
		$connection = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
		require_once(DOMAIN_ROOT . SUBS_CREDENTIALS_FILEPATH);
		new_email_set($connection, $_SESSION['user_id'], $_SESSION['new_user_email']);
		$_SESSION['user_email'] = $_SESSION['new_user_email'];
		$connection -> close();
		$phrase = 'Код подтверждения правильный.<br />Изменение электронного адреса прошло успешно.';
		break;
	case 0:
		$phrase = 'Код подтверждения неправильный.<br />Изменить электронный адрес не удалось.';
		break;
}
unset($_SESSION['new_user_email']);

echo HTML_BEGINNING . '
<p>' . $phrase . '</p>
<p><a href="' . DOMAIN_URI . USER_OPTIONS_PAGE_FILEPATH . '">Вернуться на страницу настроек</a></p>
<p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>
' . HTML_END;

?>
