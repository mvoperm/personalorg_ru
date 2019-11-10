<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID, email и folder)
require_once(DOMAIN_ROOT . SMTP_CONNECTION_FILEPATH);
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);

$_SESSION['folder_tooppen'] = '1';

$result = password_verify($_POST['pw_toconfirm_account_delition'], $_SESSION['pwhash_account_todelete']) ? 1 : 0;
unset($_SESSION['pwhash_account_todelete']);
switch ($result)	{
	case 1:
		require_once(DOMAIN_ROOT . PW_FILEPATH);
		$result = construct_mail(USER_EMAIL, USER_ID, '', 'confirm_account_deletion');
		$phrase = 'Код подтверждения правильный.<br />Запрос на удаление аккаунта направлен Администратору сервиса.<br />В случае, если у Вас удалена вся Ваша пользовательская информация, в ближайшее время аккаунт будет удалён из базы данных Пользователей.';
		break;
	case 0:
		$phrase = 'Код подтверждения неправильный.<br />Запрос на удаление аккаунта выполнен не будет.<br />Пожалуйста, попробуйте провести процедуру удаления аккаунта ещё раз или напишите письмо по адресу: <em>admin@personalorg.ru</em> .';
		break;
}

echo HTML_BEGINNING . '
<p>' . $phrase . '</p>
<p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p>
<p><a href="' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . $_SESSION['user_content'] . '">Вернуться на страницу сайта</a></p>
' . HTML_END;

?>
