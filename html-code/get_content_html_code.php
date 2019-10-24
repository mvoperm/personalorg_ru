<?php

$folderstree_html = "";
$folderstree_html_end = "";
$items_html = "";
$stack_tohandle = array('0'); // массив из [total_id] стека папок к обработке
$stack_toclose = array('0'); // массив из [total_id] стека папок к закрытию
$cycle = 1;

do {
  // Получаем Объект текущей Папки
  $current_folder_id = $stack_tohandle[count($stack_tohandle) - 1] ?? '';
  if ($current_folder_id === $stack_toclose[count($stack_toclose) - 1]) {
    $current_folder_ids = explode('-', $current_folder_id);
    $current_folder_ids_length = count($current_folder_ids);
    $current_obj = $content_obj;
    if ($current_folder_id !== '0') {
      for ($i = 0; $i < $current_folder_ids_length; $i++) {
        $current_obj = $current_obj -> folders[(integer) $current_folder_ids[$i] - 1];
      }
    }
    // Открывающая html-строка
    $insert_1 = ($current_obj -> get_total_id() === '0') ? " open='open'" : "";
    $insert_2_1 = ($current_obj -> has_subfolders()) ? "subfolders " : "";
    $insert_2_2 = ($current_obj -> get_total_id() === '0') ? "root-folderstree-details" : "folderstree-details";
    $folderstree_html .= "<details" . $insert_1 . " class='" . $insert_2_1 . $insert_2_2 . "'><summary class='folderstree-summary' data-folder-idtotal='" . $current_obj -> get_total_id() . "'>" . $current_obj -> title . "</summary>";
    $items_html .= "<section class='itemsfolder' data-folder-idtotal='" . $current_folder_id . "'><header><div><button class='toggle-folderstree-button'>&#9776;</button></div><div class='items-header'><h2>" . $current_obj -> title . "</h2>" . "</header>";
    for ($i = 0; $i < count($current_obj -> items) ; $i++) {
      $items_html .= "<article data-folder-idtotal='" . $current_folder_id . "' data-idlocal='" . (string) ($i + 1) . "' class='item " . ${$content}[0] . "'><div class='item-header'><h4>" . $current_obj -> items[$i] -> title . "</h4></div>";
      switch ($content) {
        case 'bookmarks':
          $items_html .= "<p class='uri'><a href='" . $current_obj -> items[$i] -> uri  . "' target='_blank'>" . $current_obj -> items[$i] -> uri . "</a></p>";
          $items_html .= "<p class='multipar-text'>" . $current_obj -> items[$i] -> text[0] . "</p>";
          break;
        case 'notes':
          for ($j = 0; $j < count($current_obj -> items[$i] -> text); $j++) {
            $items_html .= "<p class='multipar-text'>" . $current_obj -> items[$i] -> text[$j] . "</p>";
          }
          break;
        case 'options':
          // code...
          break;
        default:
          // code...
          break;
      }
      $items_html .= "</article>";
    }
    $items_html .= "</section>";
    array_pop($stack_tohandle);
    if ($current_obj -> has_subfolders()) {
      $subfolders_length = count($current_obj -> folders);
      for ($i = $subfolders_length - 1; $i > -1; $i--) {
        array_push($stack_tohandle, $current_obj -> folders[$i] -> get_total_id());
        array_push($stack_toclose, $current_obj -> folders[$i] -> get_total_id());
      }
    }
  } else {
    $current_folder_id = $stack_toclose[count($stack_toclose) - 1];
    $current_folder_ids = explode('-', $current_folder_id);
    $current_folder_ids_length = count($current_folder_ids);
    $current_obj = $content_obj;
    if ($current_folder_id !== '0') {
      for ($i = 0; $i < $current_folder_ids_length; $i++) {
        $current_obj = $current_obj -> folders[(integer) $current_folder_ids[$i] - 1];
      }
    }
    $folderstree_html .= "</details>" ;
    array_pop($stack_toclose);
  }
  $cycle++;
} while (count($stack_toclose) !== 0 && $cycle < 100);

?>
