<?php
require_once(DOMAIN_ROOT . SQL_GENERAL_FILEPATH);

/* СПЕЦИАЛЬНЫЕ ФУНКЦИИ */
// Получение значения столбца по значению ID (частный случай функции 'select_from_where()')
function get_from_id($connection, $table, $id_value, $result_column)	{
	$result_value = select_from_where($connection, $table, 'ID', 'i', $id_value, $result_column);
	return $result_value;
}
// Получение значения столбца по значению электронной почты (частный случай функции 'select_from_where()')
function get_from_email($connection, $table, $email_value, $result_column)	{
	$result_value = select_from_where($connection, $table, 'email', 's', $email_value, $result_column);
	return $result_value;
}
// Получение значения столбца по значению логина (ID или электронной почты)
function get_from_login($connection, $table, $login_value, $login_type, $result_column)	{
	$result_value = ($login_type == 'ID') ? get_from_id($connection, $table, $login_value, $result_column) : get_from_email($connection, $table, $login_value, $result_column);
	return $result_value;
}
// Проверка наличия логина (ID или email)
function login_existence($connection, $table, $login_value, $login_type)	{
	$result_value = get_from_login($connection, $table, $login_value, $login_type, $login_type);
	$existence = ($result_value !== 'NO_VALUE') ? 1 : 0;
	return $existence;
}

/* АВТОРИЗАЦИОННЫЕ ФУНКЦИИ */
// Авторизация пользователя
function user_login($connection, $id_value, $login_type)	{
	$param_tobind_type = ($login_type == 'ID') ? 'i' : 's';
	$pw_hash = select_from_where($connection, TABLE_CREDENTIALS, 'ID', 'i', $id_value, 'password');
	if ($pw_hash == 'NO_VALUE')	{
		$result = -1;
	} else	{
		$result = password_verify(PASSWORD, $pw_hash) ? 1 : 0;
	}
	return $result;
}
// Добавление нового пользователя (присваивается продекларированный адрес электронной почты)
function add_user($connection, $email)	{
	$unic_email = get_from_email($connection, TABLE_CREDENTIALS, $email, 'email');
	if ($unic_email !== 'NO_VALUE')	{return 0; exit();}
	$stmt = $connection -> prepare('INSERT INTO ' . TABLE_CREDENTIALS .'(email) VALUES(?)');
	$stmt -> bind_param('s', $email);
	$stmt -> execute();
	$stmt -> close();
	return 1;
}
// Установка нового адреса электронной почты по значению ID (частный случай функции 'update_set_where()')
function new_email_set($connection, $id_value, $new_email)	{
	$affected_rows_count = update_set_where($connection, TABLE_CREDENTIALS, 'ID', 'i', $id_value, 'email', 's', $new_email);
	return $affected_rows_count;
}
// Установка нового адреса электронной почты по значению ID (частный случай функции 'update_set_where()')
function folder_set($connection, $id_value, $folder_value)	{
	$affected_rows_count = update_set_where($connection, TABLE_CREDENTIALS, 'ID', 'i', $id_value, 'folder', 's', $folder_value);
	return $affected_rows_count;
}

/* ПАРОЛЬ */
// Генерация пароля
function pw_generation($pw_length = 12)	{
	$password = '';
	for ($i = 0; $i < $pw_length; $i++)	{
		do {
			$symbol_number = mt_rand(48, 122);
		} while (($symbol_number > 57 && $symbol_number < 65) || ($symbol_number > 90 && $symbol_number < 95) || $symbol_number == 96);
		$password .= chr($symbol_number);
	}
	return $password;
}
// Установка нового пароля по значению ID (частный случай функции 'update_set_where()')
function pw_hash_set($connection, $id_value, $pw_hash)	{
	$affected_rows_count = update_set_where($connection, TABLE_CREDENTIALS, 'ID', 'i', $id_value, 'password', 's', $pw_hash);
	return $affected_rows_count;
}

?>
