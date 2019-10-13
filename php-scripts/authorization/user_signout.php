<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

session_destroy();
header('refresh:0; url = ' . DOMAIN_URI . START_AUTH_FORM_FILEPATH);
?>