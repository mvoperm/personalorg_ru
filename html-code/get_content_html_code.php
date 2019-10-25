<?php

$folderstree_html = "";
$relocationtree_html = "<ul class='root-relocation-tree-ul'>";
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
    $span_ancestors_branch = '';
    if ($current_folder_id !== '0') {
      for ($i = 0; $i < $current_folder_ids_length; $i++) {
        $current_obj = $current_obj -> folders[(integer) $current_folder_ids[$i] - 1];
        if ($i < $current_folder_ids_length - 1) {
          $span_ancestors_branch .=
          "<span class='itemsfolder-branch-ancestor' data-startfolder='{$current_obj -> get_total_id()}'> {$current_obj -> title}</span> &#8594;";
        }
      }
    }
    // Открывающая html-строка
    $insert_1 = ($current_obj -> get_total_id() === '0') ? " open" : "";
    $insert_2_1 = ($current_obj -> has_subfolders()) ? "subfolders " : "";
    $insert_2_2 = ($current_obj -> get_total_id() === '0') ? "root-folderstree-details" : "folderstree-details";
    $folderstree_html .= "<details{$insert_1} class='{$insert_2_1}{$insert_2_2}'><summary class='folderstree-summary' data-folder-idtotal='{$current_obj -> get_total_id()}'>{$current_obj -> title}</summary>";
    $is_root = ($current_folder_id === '0') ? array('root-', ' checked') : array('', '') ;
    $relocationtree_html .= "<li class='{$is_root[0]}relocation-tree-li checkbox-radio-par'><label><input type='radio' name='relocation_destination_folder'{$is_root[1]} value='{$current_obj -> get_total_id()}'> <span class='relocation-tree-li-label'>{$current_obj -> title}</span></label></li>";
    $items_html .= "<section class='itemsfolder' data-folder-idtotal='{$current_folder_id}'><header><div><button class='toggle-folderstree-button'>&#9776;</button>";
    if ($content !== 'options' && $current_folder_id !== '0') {
      $items_html .= "<nav class='itemsfolder-branch-nav'><span class='itemsfolder-branch-ancestor' data-startfolder='0'>{${$content}[1]}</span> &#8594;{$span_ancestors_branch}</nav>";
    }
    $items_html .= "</div>";
    $items_html .= "<div class='items-header'><h2 class='items-h2'>{$current_obj -> title}</h2>";
    if ($content !== 'options') {
      $items_html .= "
      <details class='editmenu'><summary title='Меню' class='editmenu-summary'>&#65049;</summary><menu class='editmenu-subdetails'>
      <p class='command-button'><button class='editmenu-button' data-edit-type='add' data-element-toedit-type='item'>Добавить {${$content}[3]}</button></p>
      <p class='command-button'><button class='editmenu-button' data-edit-type='add' data-element-toedit-type='folder'>Добавить папку</button></p>
      ";
      if ($current_folder_id !== '0') {
        $items_html .= "
        <p class='command-button'><button class='editmenu-button' data-edit-type='edit' data-element-toedit-type='folder'>Переименовать папку</button></p>
        <p class='command-button'><button class='editmenu-button' data-edit-type='relocate' data-element-toedit-type='folder'>Переместить папку</button></p>
        <p class='command-button'><button class='editmenu-button' data-edit-type='delete' data-element-toedit-type='folder'>Удалить папку</button></p>
        ";
      }
      $items_html .= "</menu></details>";
    }
    $items_html .= "</div></header>";
    for ($i = 0; $i < count($current_obj -> items) ; $i++) {
      $items_html .= "<article data-folder-idtotal='{$current_folder_id}' data-idlocal='" . (string) ($i + 1) . "' class='item {${$content}[0]}'><div class='item-header'><h4 class='item-h4-";
      $items_html .= ($content === 'bookmarks') ? 'bookmarks' : 'notes';
      $items_html .= "'>{$current_obj -> items[$i] -> title}</h4>";
      if ($content !== 'options') {
        $items_html .= "
        <details class='editmenu'><summary title='Меню' class='editmenu-summary'>&#65049;</summary><menu class='editmenu-subdetails'>
        <p class='command-button'><button class='editmenu-button' data-edit-type='edit' data-element-toedit-type='item'>Редактировать {${$content}[3]}</button></p>
        <p class='command-button'><button class='editmenu-button' data-edit-type='relocate' data-element-toedit-type='item'>Переместить {${$content}[3]}</button></p>
        <p class='command-button'><button class='editmenu-button' data-edit-type='delete' data-element-toedit-type='item'>Удалить {${$content}[3]}</button></p>
        </menu></details>
        ";
      }
      $items_html .= "</div>";
      switch ($content) {
        case 'bookmarks':
          $items_html .= "<p class='uri'><a href='{$current_obj -> items[$i] -> uri}' target='_blank'>{$current_obj -> items[$i] -> uri}</a></p>";
          $items_html .= "<p class='annotation'>{$current_obj -> items[$i] -> text[0]}</p> ";
          break;
        case 'notes':
          for ($j = 0; $j < count($current_obj -> items[$i] -> text); $j++) {
            $items_html .= "<p class='multipar-text'>{$current_obj -> items[$i] -> text[$j]}</p>";
          }
          break;
        case 'options':
          // Из файла XSLT 09
          for ($j = 0; $j < count($current_obj -> items[$i] -> text); $j++) {
            $items_html .= "<p class='options-text'>{$current_obj -> items[$i] -> text[$j]}</p>";
          }
          //
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
      $relocationtree_html .= "<ul class='relocation-tree-ul'>";
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
    if ($current_obj -> has_subfolders()) {$relocationtree_html .= "</ul>";}
    array_pop($stack_toclose);
  }
  $cycle++;
} while (count($stack_toclose) !== 0 && $cycle < 100);

$relocationtree_html .= "</ul>";

?>
