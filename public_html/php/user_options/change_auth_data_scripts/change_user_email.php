<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов
require_once(DOMAIN_ROOT . PHP_FOLDER . '/authorization/filepaths_authorization.php'); // Константы адресов файлов блока авторизации

$_SESSION['folder_tooppen'] = '1';

require_once(DOMAIN_ROOT . PW_FILEPATH);
$connection = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
require_once(DOMAIN_ROOT . FILE_SYSTEM_FILEPATH); // Операции с файлами и папками
require_once(DOMAIN_ROOT . SUBS_USER_OPTIONS_FILEPATH); // Подпрограммы, связанные с получением и изменением настроек Пользователя
require_once(DOMAIN_ROOT . SUBS_CREDENTIALS_FILEPATH);
require_once(DOMAIN_ROOT . SMTP_CONNECTION_FILEPATH);
require_once(DOMAIN_ROOT . HTML_FRAGMENTS_FILEPATH);
define('NEW_USER_EMAIL', htmlspecialchars($_POST['new_user_email'], ENT_QUOTES, 'UTF-8'));

$unic_email = get_from_email($connection, TABLE_CREDENTIALS, NEW_USER_EMAIL, 'email');
if ($unic_email !== 'NO_VALUE')	{die(HTML_BEGINNING . '<p>Введённый электронный адрес не является уникальным.</p><p><a href="' . DOMAIN_URI . USER_OPTIONS_FILEPATH . '">Вернуться на страницу настроек</a></p>' . HTML_END);}

$_SESSION['new_user_email'] = NEW_USER_EMAIL;
$pw = pw_generation(4);
$_SESSION['pwhash_email_tochange'] = password_hash($pw, PASSWORD_DEFAULT);

$result = construct_mail(NEW_USER_EMAIL, '', $pw, 'email_change');
// Обработать !$result
header( 'refresh:0; url = ' . DOMAIN_URI . USER_OPTIONS_PAGE_FILEPATH );

?>
