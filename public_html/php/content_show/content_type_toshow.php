<?php

/* Определение контента для загрузки страницы */

if (isset($_GET['content']))	{
	$correct_content = false;
	for ($i = 0; $i < CONTENT_LIST_LENGHT; $i++)	{
		if ($_GET['content'] === $contentslist[$i])	{$correct_content = true;}
	}
	$content = ($correct_content) ? htmlspecialchars($_GET['content'], ENT_QUOTES, 'UTF-8') : $contentslist[0];
} else	{
	$content = $contentslist[0];
}
if ($content != 'options')	{$_SESSION['user_content'] = $content;} // Запоминает, на какую страницу надо вернуться со страницы настроек

?>
