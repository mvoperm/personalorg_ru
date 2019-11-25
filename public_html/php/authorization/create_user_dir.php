<?php

/* Создание папки пользователя */

function create_user_dir($user_folder)	{
	$success = mkdir(USERS_DIR . $user_folder);
	$template_file = USERS_DIR . 'optionslist_default.json'; // сменить расширение файла
	$result_file = USERS_DIR . $user_folder . '/optionslist.json'; // сменить расширение файла
	copy($template_file, $result_file);
	return $success;
}

?>
