<?php

define('USERS_DIR', SERVER_ROOT . '/users/');

// Создание папки пользователя
function create_user_dir($user_folder)	{
	$success = mkdir(USERS_DIR . $user_folder);
	$template_file = USERS_DIR . 'optionslist_default.json'; // сменить расширение файла
	$result_file = USERS_DIR . $user_folder . '/optionslist.json'; // сменить расширение файла
	copy($template_file, $result_file);
	return $success;
}

// Открытие или создание файла content пользователя
function get_xml_content($user_folder, $content)	{
	if ($content == 'options')	{
		$result_file = USERS_DIR . 'optionspage.xml';
	} else	{
		$result_file = USERS_DIR . $user_folder . '/' . $content . '.xml';
		if (file_exists($result_file) === false) {
			$template_file = USERS_DIR . 'content_template.xml';
			$success = copy($template_file, $result_file);
			if ($success === false)	{$result_file = '';}
		}
	}
	return $result_file;
}

?>
