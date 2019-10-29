<?php

/* НАЗНАЧЕНИЕ БАЗОВЫХ КОНСТАНТ И ГЛОБАЛЬНЫХ ПЕРЕМЕННЫХ */

// Получение из запроса POST + производные
define('CONTENT_NAME', $_POST['content_name']); // 'notes', 'bookmarks' и т.п.
define('FOLDER_ID', $_POST['currentfolder_idtotal']);
define('CURRENTPARENT_ID', $_POST['currentparent_idtotal']);
define('ID_LOCAL', $_POST['item_idlocal']);
define('ELEMENT_TOEDIT_TYPE', $_POST['element_toedit_type']); // 'folder' или 'item'
define('ELEMENT_EDIT_TYPE', $_POST['element_edit_type']); // 'delete', 'add', 'edit' или 'relocate'
define('ELEMENT_TITLE', htmlspecialchars($_POST['element_title'], ENT_QUOTES, 'UTF-8'));
define('ITEM_URI', htmlspecialchars($_POST['item_uri'], ENT_QUOTES, 'UTF-8'));
define('ITEM_TEXT', htmlspecialchars($_POST['item_text'], ENT_QUOTES, 'UTF-8'));
define('RELOCATION_DESTINATION_FOLDER', $_POST['relocation_type'] == 'in_folder' ? CURRENTPARENT_ID : $_POST['relocation_destination_folder']);
define('RELOCATION_ORDER_SETNUMBER', ($_POST['relocation_order_setnumber'] > $_POST['relocation_maxordernumber']) ? $_POST['relocation_maxordernumber'] : $_POST['relocation_order_setnumber']);
define('RELOCATION_MAXORDERNUMBER', $_POST['relocation_maxordernumber']);
define('HAS_ITEMS', $_POST['has_items']); // Наличие items в папке для определения применения метода insertBefore() или appendChild() для папки
define('PARENTFOLDER_IDTOTAL', $_POST['parentfolder_idtotal']);
define('FOLDER_TOOPEN', $_POST['folder_tooppen']);
define('FILEPATH', DOMAIN_ROOT . '/users/' . USER_FOLDER . '/' . CONTENT_NAME . '.xml'); // Путь к файлу XML

// Создание дополнительных переменных с использованием встроенных функций
$current_folders = explode('-', FOLDER_ID); // Массив порядковых номеров папок для текущей в дереве папок (для новой при add)
$destination_folders = explode('-', PARENTFOLDER_IDTOTAL); // Массив порядковых номеров папок для целевой в дереве папок для relocate

?>
