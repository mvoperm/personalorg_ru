<?php

/* Информация о переходах и номере папки, которую надо отобразить */

if ($content != 'options' && isset($_SESSION['options_ascontent']))	{ // Если переходим из Настроек на страницу Пользовательского контента
	$startfolder = '0';
	unset($_SESSION['options_ascontent']);
} else if ($content == 'options' && !isset($_SESSION['options_ascontent']))	{ // Если переходим со страницы Пользовательского контента в Настройки
	$startfolder = '2';
	$_SESSION['options_ascontent'] = true;
} else if (isset($_SESSION['folder_tooppen'])) 	{
	$startfolder = $_SESSION['folder_tooppen'];
} else {
	$startfolder = ($content != 'options') ? '0' : '2';
}
unset($_SESSION['folder_tooppen']);

?>
