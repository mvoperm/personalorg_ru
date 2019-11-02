<?php

function get_editmenu_code($element_type, $itemname_accus, $is_root = true) {
  $editmenu_html = "<details class='editmenu'><summary title='Меню' class='editmenu-summary'>&#65049;</summary><menu class='editmenu-subdetails'>";
  $line_beginning = "<p class='command-button'><button class='editmenu-button' data-edit-type='";
  $line_middle_item = "' data-element-toedit-type='item'>";
  $line_middle_folder = "' data-element-toedit-type='folder'>";
  $line_end = "</button></p>";
  switch ($element_type) {
    case 'folder':
      $editmenu_html .= $line_beginning . 'add' . $line_middle_item . 'Добавить ' . $itemname_accus . $line_end;
      $editmenu_html .= $line_beginning . 'add' . $line_middle_folder . 'Добавить папку' . $line_end;
      if ($is_root === false) {
        $editmenu_html .= $line_beginning . 'edit' . $line_middle_folder . 'Переименовать папку' . $line_end;
        $editmenu_html .= $line_beginning . 'relocate' . $line_middle_folder . 'Переместить папку' . $line_end;
        $editmenu_html .= $line_beginning . 'delete' . $line_middle_folder . 'Удалить папку' . $line_end;
      }
      break;
    case 'item':
      $editmenu_html .= $line_beginning . 'edit' . $line_middle_item . 'Редактировать ' . $itemname_accus . $line_end;
      $editmenu_html .= $line_beginning . 'relocate' . $line_middle_item . 'Переместить ' . $itemname_accus . $line_end;
      $editmenu_html .= $line_beginning . 'delete' . $line_middle_item . 'Удалить ' . $itemname_accus . $line_end;
      break;
    default:
      // code...
      break;
  }
  $editmenu_html .= "</menu></details>";
  return $editmenu_html;
}

?>
