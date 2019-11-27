<?php

/* Проверка авторизации */
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH); // Начало и окончание страницы для рабочих объявлений
if (!isset($_SESSION['user_id']))	{
	die(HTML_BEGINNING . '<p>Для отображения содержимого данной страницы необходима авторизация.</p><p><a href="/" target="_blank">На страницу авторизации [&#8663;]</a></p>' . HTML_END);
}

?>
