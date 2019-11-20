<?php

function get_default_options()	{ /* Определяет массив имеющихся настоек пользователя, чтобы вставить его значения в случае отсутствия куки. Используется файлом 'content.php', который создаёт соответствующие переменные для файла 'content.xsl' */
	$content_def_filepath = USERS_DIR . 'optionslist_default.json';
	$content_filepath = USERS_DIR . USER_FOLDER . '/optionslist.json';
	$json_file_default = file_get_contents($content_def_filepath); // Получение содержимого файла
	$json_file_user = file_get_contents($content_filepath);
	$json_obj_default = json_decode($json_file_default, true); // Формирование объекта
	$json_obj_user = json_decode($json_file_user, true);
	for ($i = 0; $i < USER_OPTIONS_CONSTANTS_LIST_LENGTH; $i++)	{
		$option_key = USER_OPTIONS_CONSTANTS_LIST[$i][0];
		$option_value = (isset($json_obj_user[$option_key])) ? $json_obj_user[$option_key] : $json_obj_default[$option_key];
		define(USER_OPTIONS_CONSTANTS_LIST[$i][2], $option_value);
	}
}

function set_default_options($options, $new_values)	{ /* Установка настройки Пользователя для всех устройств */
	$content_filepath = USERS_DIR . USER_FOLDER . '/optionslist.json';
	$json_file_user = file_get_contents($content_filepath);
	$json_obj_user = json_decode($json_file_user, true);
	$success = true;

	$array_length = count($options);
	for ($i = 0; $i < $array_length; $i++)	{
		$json_obj_user[$options[$i]] = $new_values[$i];
		//if ($result === false)	{$success = false;}
	}
	$json_file_user = json_encode($json_obj_user);
	$success = file_put_contents($content_filepath, $json_file_user);
	return $success;
}

?>
