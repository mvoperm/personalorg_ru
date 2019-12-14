<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов
require_once(DOMAIN_ROOT . FILEPATHS_USER_OPTIONS_FILEPATH); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов для страницы настроек
require_once(DOMAIN_ROOT . FILEPATHS_AUTH_FILEPATH); // Константы адресов файлов блока авторизации

$_SESSION['folder_tooppen'] = '1';

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID, email и folder)
require_once(DOMAIN_ROOT . SUBS_CREDENTIALS_FILEPATH);
require_once(DOMAIN_ROOT . SMTP_CONNECTION_FILEPATH);

$pw = pw_generation(4);
$_SESSION['pwhash_account_todelete'] = password_hash($pw, PASSWORD_DEFAULT);

$result = construct_mail(USER_EMAIL, '', $pw, 'account_deletion');
// Обработать !$result
header( 'refresh:0; url = ' . DOMAIN_URI . USER_OPTIONS_PAGE_FILEPATH );

?>
