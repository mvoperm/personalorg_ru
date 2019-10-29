<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

// Создание основных констант, глобальных переменных и загрузка функций
define('AUTH_ACTION', $_POST['authorization_action']);
define('LOGIN', htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8'));
define('PASSWORD', $_POST['password']);
// define('REMEMBER_ME', $_POST['remember_me']); // к дальнейшей проработке
require_once(DOMAIN_ROOT . PW_FILEPATH);
$connection = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
require_once(DOMAIN_ROOT . SUBS_CREDENTIALS_FILEPATH);
require_once(DOMAIN_ROOT . SMTP_CONNECTION_FILEPATH);
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);
$_SESSION['touchscreen_value'] = $_POST['touchscreen_value'];

// Назначение глобальных переменных id, email и folder. Для этого при регистрации сразу создаётся пользователь.
if (AUTH_ACTION == 'user_signin')	{
	$add_success = add_user($connection, LOGIN);
	if ($add_success == 0)	{die (HTML_BEGINNING . '<p>Данный адрес электронной почты уже зарегистрирован в системе. Регистрация нового пользователя выполнена не будет.</p>' . HTML_END);}
}
$login_type = (substr_count(LOGIN, '@') == 1) ? 'email' : 'ID';
$id_value = ($login_type == 'ID') ? LOGIN : get_from_email($connection, TABLE_CREDENTIALS, LOGIN, 'ID');
$email_value = ($login_type == 'email') ? LOGIN : get_from_id($connection, TABLE_CREDENTIALS, LOGIN, 'email');
$folder_value = (AUTH_ACTION == 'user_signin') ? $id_value . pw_generation(14) : get_from_id($connection, TABLE_CREDENTIALS, $id_value, 'folder');


// Установка куки
/*
if (REMEMBER_ME == 'on')	{
	setcookie('login', LOGIN, time() + 2592000, '/', 'complexorg', false);
} else	{
	setcookie('login', LOGIN, time() - 2592000, '/', 'complexorg', false);
}
*/ // к дальнейшей проработке

switch (AUTH_ACTION)	{
	case 'user_login':
		$result = user_login($connection, $id_value, $login_type);
		switch ($result)	{
			case -1:
				die(HTML_BEGINNING . '<p>Логин введён неправильно.</p><p>Вернуться на <a href="' . DOMAIN_URI . START_AUTH_FORM_FILEPATH . '">страницу авторизации</a></p>' . HTML_END);
				break;
			case 0:
				die(HTML_BEGINNING . '<p>Пароль введён неправильно.</p><p>Вернуться на <a href="' . DOMAIN_URI . START_AUTH_FORM_FILEPATH . '">страницу авторизации</a></p>' . HTML_END);
				break;
			case 1:
				$registration_datetime = get_from_id($connection, TABLE_CREDENTIALS, $id_value, 'registration_datetime');
				if ($registration_datetime == '0000-00-00 00:00:00')	{update_set_now_where($connection, TABLE_CREDENTIALS, 'ID', 'i', $id_value, 'registration_datetime');}
				$_SESSION['user_id'] = $id_value;
				$_SESSION['user_email'] = $email_value;
				$_SESSION['user_folder'] = $folder_value;
				$_SESSION['folder_tooppen'] = '0';
				break;
		}
		break;
	case 'user_signin':
		$pw = pw_generation();
		$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
		pw_hash_set($connection, $id_value, $pw_hash);
		$result = folder_set($connection, $id_value, $folder_value);
		// Обработать !$result
		require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH);
		if (create_user_dir($folder_value) != 1)	{die(HTML_BEGINNING . '<p>Не удалось создать папку для пользователя. Пожалуйста, обратитесь к администратору сервиса.</p>' . HTML_END);}
		$result = construct_mail(LOGIN, $id_value, $pw, 'signin');
		// Обработать !$result
		break;
	case ('password_recovery'):
		$existence = login_existence($connection, TABLE_CREDENTIALS, LOGIN, $login_type);
		if ($existence == 0) {die (HTML_BEGINNING . '<p>Такого логина не существует.</p><p>Вернуться на <a href="' . DOMAIN_URI . START_AUTH_FORM_FILEPATH . '">страницу авторизации</a></p>' . HTML_END);}
		$pw = pw_generation();
		$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
		pw_hash_set($connection, $id_value, $pw_hash);
		$result = construct_mail($email_value, $id_value, $pw, 'pw_recovery');
		// Обработать !$result
		break;
}


$connection -> close();
if (AUTH_ACTION == 'user_login' && isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_folder']))	{
	header( 'refresh:0; url = ' . DOMAIN_URI . START_CONTENT_FILEPATH );
} else	{
	echo HTML_BEGINNING . '<p>Операция регистрации/восстановление пароля  прошла успешно.<br />Пароль направлен на электронную почту.</p><p>Вернуться на <a href="' . DOMAIN_URI . START_AUTH_FORM_FILEPATH . '">страницу авторизации</a></p>' . HTML_END;
}

?>
