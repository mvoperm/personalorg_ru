<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов

session_destroy();
header('refresh:0; url = ' . DOMAIN_URI . START_AUTH_FORM_FILEPATH);
?>
