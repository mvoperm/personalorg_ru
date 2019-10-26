<?php

require_once(DOMAIN_ROOT . HTML_CLASSES_FILEPATH); // Объявление классов Объектов разметки (html / xml)

// Загрузка документа и таблицы стилей в переменные
$content_filepath = get_xml_content(USER_FOLDER, $content);
if ($content_filepath === '')	{die ('Не удалось загрузить файл с информацией Пользователя.');}

$xml = new DOMDocument();
$xml -> load($content_filepath);
$xpath = new DOMXPath($xml);
$root_folder = $xml -> getElementsByTagName('content') -> item(0); // Получили корневой узел XML
$content_obj = new Folder; // Создали объект Folder из корневого узла XML
$content_obj -> title = ${$content}[1]; // 'Закладки'
$content_obj -> local_id = '0';
$queue = array('0'); // массив из [total_id] очереди перебора папок

$cycle = 1;
/* Цикл учёта детей текущей Папки */
do {
  $current_folder_id = $queue[0];
	$current_folder_queryline = '/content';
  $current_obj = $content_obj;

  /* Блок IF вычисляет: 1) путь XPATH к обрабатываемому узлу DOM folder; 2) путь текущего объекта Folder, который создан ранее */
  if ($current_folder_id !== '0') {
    $current_folder_ids = explode('-', $current_folder_id);
    $current_folder_ids_length = count($current_folder_ids);
    for ($i = 0; $i < $current_folder_ids_length; $i++) {
			$current_folder_queryline .= "/folder[{$current_folder_ids[$i]}]";
      $current_obj = $current_obj -> folders[((integer) $current_folder_ids[$i]) - 1];
    }
  }

	/* Вычисление количества объектов обрабатываемого узла DOM folder */
	$current_folder = $xpath -> query($current_folder_queryline) -> item(0); // Текущий узел DOM folder в соответствии с вычисленным в цикле путём
  $titles_number = $xpath -> evaluate('count(title)', $current_folder); // Вычисление количества детей title
  $folders_number = $xpath -> evaluate('count(folder)', $current_folder); // Вычисление количества детей folder
  $items_number = $xpath -> evaluate('count(item)', $current_folder); // Вычисление количества детей item

  /* Блок FOR: 1) создаёт Объект Folder; 2) присваивает ему title, parent_id и local_id; 3) включает его в массив Объектов folders текущего Folder; 4) добавляет в массив очереди для обхода */
  for ($j = 0; $j < $folders_number; $j++) {
		// Обработка узла XML
		$child_folder_queryline = $current_folder_queryline . '/folder['. (string)($j + 1) . ']';
		$child_folder =  $xpath -> query($child_folder_queryline) -> item(0);
    $query_title = 'count(title)';
    $child_titles_number = $xpath -> evaluate($query_title, $child_folder);
    if ($child_titles_number === 0) {die('Заголовок Папки отсутствует');}
    if ($child_titles_number > 1) {die('Заголовков в Папке больше одного');}
		// Создание Объекта Folder и присвоение ему свойств
	  $child_obj =  new Folder;
    $child_obj -> parent_id = $current_folder_id;
    $child_obj -> local_id = (string) ($j + 1);
    $child_obj -> title = $xpath -> query($child_folder_queryline . '/title[1]') -> item(0) -> textContent;
		// Добавление нового Объекта в родительский и ID Папки в массив очереди для обхода
    array_push($current_obj -> folders, $child_obj);
    array_push($queue, $child_obj -> get_total_id());
  }

	/* Блок FOR создаёт Объекты Item для обрабатываемой Folder, присваивает им все свойства и включает их в массив Объектов items текущей Папки */
	for ($k = 0; $k < $items_number; $k++) {
		$child_item_queryline = $current_folder_queryline . '/item['. (string)($k + 1) . ']';
		$current_item = $xpath -> query($child_item_queryline) -> item(0); // Текущий узел DOM folder в соответствии с вычисленным в цикле путём
		// Создание Объекта и присвоение ему свойств
	  $child_obj =  new Item;
    $child_obj -> parent_id = $current_folder_id;
    $child_obj -> local_id = (string) ($j + 1);
    $child_obj -> title = $xpath -> query($child_item_queryline . '/title[1]') -> item(0) -> textContent;
		switch ($content) {
			case 'bookmarks':
				$child_obj -> uri = $xpath -> query($child_item_queryline . '/source[1]') -> item(0) -> textContent;
				$text_par = $xpath -> query($child_item_queryline . '/annotation[1]') -> item(0) -> textContent;
				array_push($child_obj -> text, $text_par);
				break;
			case 'notes':
				$pars_number = $xpath -> evaluate('count(par)', $current_item);
				for ($l = 0; $l < $pars_number; $l++) {
					$child_par_queryline = $child_item_queryline . '/par['. (string)($l + 1) . ']';
					$text_par = $xpath -> query($child_par_queryline) -> item(0) -> textContent;
					array_push($child_obj -> text, $text_par);
				}
				break;
			case 'options':
				$codes_number = $xpath -> evaluate('count(code)', $current_item);
				for ($l = 0; $l < $codes_number; $l++) {
					$child_par_queryline = $child_item_queryline . '/code['. (string)($l + 1) . ']';
					$code = $xpath -> query($child_par_queryline) -> item(0) -> textContent;
					array_push($child_obj -> text, $code);
				}
				break;
			default:
				die('Ошибка в программе на стадии выбора типа контента в формировании объекта Item.');
				break;
		}
		// Добавление нового Объекта в родительский и ID Папки в массив очереди для обхода
    array_push($current_obj -> items, $child_obj);
	}

  array_shift($queue);
} while (count($queue) !== 0 && $cycle < 8);

?>
