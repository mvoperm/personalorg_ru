<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл с константами путей к требуемым файлам php-скриптов

$is_test_mode = isset($_SESSION['test_mode']) ? 1 : 0;
switch ($is_test_mode)	{
	case 1:
		unset($_SESSION['test_mode']);
		break;
	default:
		$_SESSION['test_mode'] = 1;
		break;
}

header( 'refresh:0; url = ' . DOMAIN_URI . START_CONTENT_FILEPATH );
?>
