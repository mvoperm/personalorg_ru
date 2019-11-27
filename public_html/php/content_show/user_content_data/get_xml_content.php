<?php

/* Открытие или создание файла content пользователя */

function get_xml_content($user_folder, $content)	{
		$result_file = USERS_DIR . $user_folder . '/' . $content . '.xml';
		if (file_exists($result_file) === false) {
			$template_file = USERS_DIR . 'content_template.xml';
			$success = copy($template_file, $result_file);
			if ($success === false)	{$result_file = '';}
		}
	return $result_file;
}

?>
