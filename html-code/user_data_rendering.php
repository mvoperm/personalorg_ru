<?php

require_once(DOMAIN_ROOT . HTML_CLASSES_FILEPATH); // Объявление классов Объектов разметки (html / xml)

//$xml = new DOMDocument(); $xml -> load($content_filepath);
//$xmlstr = $xml -> saveXML();

$xmlstr = <<<EOT
<content>
	<folder>
		<title>Заголовок папки 1</title>
		<folder>
			<title>Заголовок папки 1.1</title>
			<item>
				<title>Заголовок заметки 1.1.1</title>
				<par>Параграф 1 заметки 1.1.1</par>
				<par>Параграф 2 заметки 1.1.1</par>
			</item>
		</folder>
		<folder>
			<title>Заголовок папки 1.2</title>
			<item>
				<title>Заголовок заметки 1.2.1</title>
				<par>Параграф 1 заметки 1.2.1</par>
				<par>Параграф 2 заметки 1.2.1</par>
			</item>
			<item>
				<title>Заголовок заметки 1.2.2</title>
				<par>Параграф 1 заметки 1.2.2</par>
				<par>Параграф 2 заметки 1.2.2</par>
			</item>
			<item>
				<title>Заголовок заметки 1.2.3</title>
				<par>Параграф 1 заметки 1.2.3</par>
				<par>Параграф 2 заметки 1.2.3</par>
			</item>
		</folder>
	</folder>
	<folder>
		<title>Заголовок папки 2</title>
	</folder>
	<item>
		<title>Заголовок заметки 1</title>
		<par>Параграф 1 заметки 1</par>
		<par>Параграф 2 заметки 1</par>
		<par>Параграф 3 заметки 1</par>
	</item>
</content>
EOT;

$queue = array('0'); // массив из [total_id] очереди перебора папок
$xml = new DOMDocument();
$xml -> loadXML($xmlstr);
$xpath = new DOMXPath($xml);
$root_folder = $xml -> getElementsByTagName('content') -> item(0); // Получили корневой узел XML
//echo $root_folder -> getElementsByTagName('folder') -> item(0) -> getNodePath(); exit();
$content_obj = new Folder; // Создали объект Папка из корневого узла XML
$content_obj -> title = ${$content}[1]; // 'Закладки'
$content_obj -> local_id = '0';
//echo (integer) $content_obj -> has_sub_folders(); exit();
//echo $root_folder -> getNodePath() . '<br>'; // '/content'

$cycle = 1;
/* Цикл учёта детей текущей Папки */
do {
  $current_folder_id = $queue[0];
  $current_folder = $root_folder;
  $current_obj = $content_obj;
  /* Блок IF вычисляет путь текущей Папки, которая создана ранее */
  if ($current_folder_id !== '0') {
    $current_folder_ids = explode('-', $current_folder_id);
    $current_folder_ids_length = count($current_folder_ids);
    for ($i = 0; $i < $current_folder_ids_length; $i++) {
      /*!!! - заменить на xpath */ $current_folder = $current_folder -> getElementsByTagName('folder') -> item(((integer) $current_folder_ids[$i]) - 1);
      $current_obj = $current_obj -> folders[((integer) $current_folder_ids[$i]) - 1];
    }
  }

  // Вычисление количества детей title
  $query_title = 'count(title)';
  $titles_number = $xpath -> evaluate($query_title, $current_folder);
  // Вычисление количества детей folder
  $query_folder = 'count(folder)';
  $folders_number = $xpath -> evaluate($query_folder, $current_folder);
  // Вычисление количества детей item
  $query_item = 'count(item)';
  $items_number = $xpath -> evaluate($query_item, $current_folder);
  /* Блок FOR создаёт Папку как Объект, присваивает ей title, parent_id и local_id и включает её в массив Объектов folders текущей Папки */
  for ($j = 0; $j < $folders_number; $j++) {
    $child_obj =  new Folder;
    /*!!! - заменить на xpath */ $child_folder =  $current_folder -> getElementsByTagName('folder') -> item($j);
    // Присвоение title дочернего folder
    $query_title = 'count(title)';
    $child_titles_number = $xpath -> evaluate($query_title, $child_folder);
    if ($child_titles_number === 0) {die('Заголовок Папки отсутствует');}
    if ($child_titles_number > 1) {die('Заголовков в Папке больше одного');}
    $child_obj -> title = $child_folder -> getElementsByTagName('title') -> item(0) -> textContent;
    $child_obj -> parent_id = $current_folder_id;
    $child_obj -> local_id = (string) ($j + 1);
    array_push($current_obj -> folders, $child_obj);
    array_push($queue, $child_obj -> get_total_id());
  }


  echo '<br>Номер цикла: ' . $cycle++;
  echo '<br>Заголовок текущей папки: ' . $current_obj -> title;
  echo '<br>Id родительской Папки: ' . $current_obj -> parent_id;
  echo '<br>Локальный Id текущей Папки: ' . $current_obj -> local_id;
  echo '<br>Полный Id текущей Папки: ' . $current_obj -> get_total_id();
  echo '<br>Заголовков: ' . $titles_number;
  echo '<br>Папок: ' . $folders_number;
  echo '<br>Статей: ' . $items_number;
  array_shift($queue);
  echo '<br>Следующая Папка к обработке: ' . ($queue[0] ?? 'нет Папок к обработке') . '<br>';
} while (count($queue) !== 0 && $cycle < 6);

exit();

?>
