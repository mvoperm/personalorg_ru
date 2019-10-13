<?php

function get_default_options()	{ /* Определяет массив имеющихся настоек пользователя, чтобы вставить его значения в случае отсутствия куки. Используется файлом 'content.php', который создаёт соответствующие переменные для файла 'content.xsl' */
	$content_def_filepath = USERS_DIR . 'optionslist_default.json';
	$content_filepath = USERS_DIR . USER_FOLDER . '/optionslist.json';
	$json_file_default = file_get_contents($content_def_filepath); // Получение содержимого файла
	$json_file_user = file_get_contents($content_filepath);
	$json_obj_default = json_decode($json_file_default, true); // Формирование объекта
	$json_obj_user = json_decode($json_file_user, true);
	$optionlist = array(
		['basic_hue', 'DEFAULT_BASIC_HUE_TEXT'],
		['article_transparency', 'DEFAULT_ARTICLE_TRANSPARENCY_TEXT'],
		['basic_font_type', 'DEFAULT_BASIC_FONT_TYPE'],
		['basic_font_size', 'DEFAULT_BASIC_FONT_SIZE']
	);
	$optionlist_length = count($optionlist);
	for ($i = 0; $i < $optionlist_length; $i++)	{
		$option_value = ($json_obj_user[$optionlist[$i][0]]) ? $json_obj_user[$optionlist[$i][0]] : $json_obj_default[$optionlist[$i][0]];
		define($optionlist[$i][1], $option_value);
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
	file_put_contents($content_filepath, $json_file_user);
	return $success;
}

?>