<?php

/* ОБРАБОТКА ИСХОДНЫХ ПЕРЕМЕННЫХ */
// Получение массива параграфов текстового поля
function list_of_paragraphs($textwhole)	{
	$nullelement = '<nullelement></nullelement>';
	$textwholenew = preg_replace('/[\r\n]+/', $nullelement, $textwhole);
	return explode($nullelement, $textwholenew);
}

/* СОЗДАНИЕ БАЗОВЫХ ОБЪЕКТОВ (xml_document, xpath) */
function get_xml_document()	{
	$xml_document = new DomDocument();
	$xml_document -> load(FILEPATH);
	return $xml_document;
}
function get_xpath($xml_document)	{
	$xpath = new DomXPath($xml_document);
	return $xpath;
}

/* ПОЛУЧЕНИЕ ПУТИ */
// Получение пути Папки
function get_folder_queryline($folders)	{
	$queryline = '/content';
	if ($folders[0] != '0')	{
		foreach ($folders as $folder)	{
			$queryline .= '/folder[' . $folder . ']';
		}
	}
	return $queryline;
}
// Получение пути Заголовка
function get_title_queryline($folders)	{
	$folder_queryline = get_folder_queryline($folders);
	$queryline = $folder_queryline . '/title[1]';
	return $queryline;
}
// Получение пути Статьи
function get_item_queryline($folders)	{
	$folder_queryline = get_folder_queryline($folders);
	$queryline = $folder_queryline . '/item[' . ID_LOCAL . ']';
	return $queryline;
}

/* СОЗДАНИЕ УЗЛА (для добавления) */
// Создание узла Папка (для добавления)
function create_foldernode($xml_document)	{
	$new_folder = $xml_document -> createElement('folder');
	$new_folder_title = $xml_document -> createElement('title', ELEMENT_TITLE);
	$new_folder -> appendChild($new_folder_title);
	return $new_folder;
}
// Создание узла Статья (для добавления и редактирования)
function create_itemnode($xml_document)	{
	$new_item = $xml_document -> createElement('item');
	$new_item_title = $xml_document -> createElement('title', ELEMENT_TITLE);
	$new_item -> appendChild($new_item_title);
	if (CONTENT_NAME == 'bookmarks')	{
		$new_item_uri = $xml_document -> createElement('source', ITEM_URI);
		$new_item -> appendChild($new_item_uri);
	}
	$new_texts = list_of_paragraphs(ITEM_TEXT);
	$text_tag = (CONTENT_NAME == 'notes') ? 'par' : 'annotation';
	foreach ($new_texts as $text)	{
		$new_item_text = $xml_document -> createElement($text_tag, $text);
		$new_item -> appendChild($new_item_text);
	}
	return $new_item;
}
/* ПОЛУЧЕНИЕ УЗЛА (Папки или Статьи) ИЗ ДЕРЕВА*/
// Удаление узла Папка
function get_folder_fromtree($xml_document, $folders)	{
	$xpath = get_xpath($xml_document);
	$queryline = get_folder_queryline($folders);
	$current_folder = $xpath -> query($queryline) -> item(0);
	return $current_folder;
}
// Удаление узла Статья
function get_item_fromtree($xml_document, $folders)	{
	$xpath = get_xpath($xml_document);
	$queryline = get_item_queryline($folders);
	$item_fromtree = $xpath -> query($queryline) -> item(0);
	return $item_fromtree;
}

/* УДАЛЕНИЕ УЗЛА (Папки или Статьи) */
// Удаление узла Папка
function delete_folder($xml_document, $folders)	{
	$xpath = get_xpath($xml_document);
	$queryline = get_folder_queryline($folders);
	$current_folder = $xpath -> query($queryline) -> item(0);
	$current_folder -> parentNode -> removeChild($current_folder);
	return $current_folder;
}
// Удаление узла Статья
function delete_item($xml_document, $folders)	{
	$xpath = get_xpath($xml_document);
	$queryline = get_item_queryline($folders);
	$item_to_delete = $xpath -> query($queryline) -> item(0);
	$item_to_delete -> parentNode -> removeChild($item_to_delete);
	return $item_to_delete;
}

/* РЕДАКТИРОВАНИЕ УЗЛА (Заголовка или Статьи) */
// Переименование папки
function rename_folder($xml_document, $folders)	{
	$new_title_node = $xml_document -> createElement('title', ELEMENT_TITLE);
	$xpath = get_xpath($xml_document);
	$queryline = get_folder_queryline($folders);
	$current_folder = $xpath -> query($queryline) -> item(0);
	$queryline .= '/title[1]';
	$old_title = $xpath -> query($queryline) -> item(0);
	$current_folder -> replaceChild($new_title_node, $old_title);
}
// Редактирование Статьи
function edit_item($xml_document, $folders, $new_item_toreplace)	{
	$xpath = get_xpath($xml_document);
	$queryline = get_item_queryline($folders);
	$old_item_toreplace = $xpath -> query($queryline) -> item(0);
	$old_item_toreplace -> parentNode -> replaceChild($new_item_toreplace, $old_item_toreplace);
}

/* ДОБАВЛЕНИЕ УЗЛА (Папки или Статьи) */
// Добавление узла в результирующую папку с заданным порядковым номером. Перед добавлением узел надо создать!
function add_node($xml_document, $folders, $node_toadd)	{
	global $ordinal_number;
	$xpath = get_xpath($xml_document);
	$queryline = get_folder_queryline($folders);
	$current_folder = $xpath -> query($queryline) -> item(0);
	$appendMethod = ((ELEMENT_TOEDIT_TYPE == 'item' || HAS_ITEMS == 'false') && (RELOCATION_ORDER_SETNUMBER == RELOCATION_MAXORDERNUMBER));
	if ($appendMethod) {
		$current_folder -> appendChild($node_toadd);
	} else {
		$point_toadd_before_type = (RELOCATION_ORDER_SETNUMBER == RELOCATION_MAXORDERNUMBER) ? 'item' : ELEMENT_TOEDIT_TYPE;
		$ordinal_number = (RELOCATION_ORDER_SETNUMBER == RELOCATION_MAXORDERNUMBER) ? 1 : RELOCATION_ORDER_SETNUMBER;
		if (ELEMENT_EDIT_TYPE == 'relocate')	{ // Проверка на сдвиг номеров из-за удаления (при перемещении) верхнего элемента данной папки и коррекция, если требуется
			switch (ELEMENT_TOEDIT_TYPE)	{
				case 'folder':
					if ((RELOCATION_DESTINATION_FOLDER == PARENTFOLDER_IDTOTAL) && (ID_LOCAL < $ordinal_number))	{
						$ordinal_number += 1;
					}
					break;
				case 'item':
					if ((FOLDER_ID == PARENTFOLDER_IDTOTAL) && (ID_LOCAL < $ordinal_number))	{
						$ordinal_number += 1;
					}
					break;
			}
		}
		$queryline .= '/' . $point_toadd_before_type . '[' . $ordinal_number . ']';
		$point_toadd_before = $xpath -> query($queryline) -> item(0);
		$current_folder -> insertBefore($node_toadd, $point_toadd_before);
	}
}

/* ПЕРЕМЕЩЕНИЕ УЗЛА (Папки или Статьи) */
// Перемещение узла Папка
function relocate_folder($xml_document, $initial_folders, $destination_folders)	{
	$folder_torelocate = get_folder_fromtree($xml_document, $initial_folders);
	add_node($xml_document, $destination_folders, $folder_torelocate);
}

// Перемещение узла Статья
function relocate_item($xml_document, $initial_folders, $destination_folders)	{
	$item_torelocate = get_item_fromtree($xml_document, $initial_folders);
	add_node($xml_document, $destination_folders, $item_torelocate);
}

?>