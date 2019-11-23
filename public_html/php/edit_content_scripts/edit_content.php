<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/filepaths_entry.php'); // Файл-точка входа в дерево файлов с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . GET_USER_FILEPATH); // Информация о пользователе (ID и email)
require_once(DOMAIN_ROOT . CONSTANTS_CONTENT_EDIT_FILEPATH); // Константы обработки запроса Пользователя на редактирование данных
require_once(DOMAIN_ROOT . SUBS_CONTENT_EDIT_FILEPATH); // Подпрограммы, связанные с редактированием контента Пользователя

// Создание документа DomDocument и загрузка в него файла XML
$xml_document = get_xml_document();

// Выполнение редактирования
switch (ELEMENT_EDIT_TYPE)	{
	case 'add':
		switch (ELEMENT_TOEDIT_TYPE)	{
			case 'folder':
				$node_toadd = create_foldernode($xml_document);
				break;
			case 'item':
				$node_toadd = create_itemnode($xml_document);
				break;
		}
		add_node($xml_document, $current_folders, $node_toadd);
		break;
	case 'edit':
		switch (ELEMENT_TOEDIT_TYPE)	{
			case 'folder':
				rename_folder($xml_document, $current_folders);
				break;
			case 'item':
				$new_item_toreplace = create_itemnode($xml_document);
				edit_item($xml_document, $current_folders, $new_item_toreplace);
				break;
		}
		break;
	case 'relocate':
		switch (ELEMENT_TOEDIT_TYPE)	{
			case 'folder':
				if (CURRENTPARENT_ID != PARENTFOLDER_IDTOTAL || ID_LOCAL != RELOCATION_ORDER_SETNUMBER)	{
					relocate_folder($xml_document, $current_folders, $destination_folders);
				}
				break;
			case 'item':
				if (CURRENTPARENT_ID != PARENTFOLDER_IDTOTAL || ID_LOCAL != RELOCATION_ORDER_SETNUMBER)	{
					relocate_item($xml_document, $current_folders, $destination_folders);
				}
				break;
		}
		break;
	case 'delete':
		switch (ELEMENT_TOEDIT_TYPE)	{
			case 'folder':
				delete_folder($xml_document, $current_folders);
				break;
			case 'item':
				delete_item($xml_document, $current_folders);
				break;
		}
		break;
}

// Сохранение файла
$xml_document -> save(FILEPATH);
// Задание открываемой папки
$_SESSION['folder_tooppen'] = FOLDER_TOOPEN;

// Перезагрузка файла
header( 'refresh:0; url = ' . DOMAIN_URI . START_CONTENT_FILEPATH . '?content=' . CONTENT_NAME );

?>
