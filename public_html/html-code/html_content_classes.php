<?php

class Folder {
  public $title = '';
  public $parent_id = '';
  public $local_id = '';
  public $folders = [];
  public $items = [];
  public function get_total_id() {
    $total_id = ($this -> local_id === '0' || $this -> parent_id === '0') ? $this -> local_id : $this -> parent_id . '-' . $this -> local_id ;
    return $total_id;
  }
  public function has_subfolders() {
    return count($this -> folders) > 0;
  }
}

class Item {
  public $parent_id = '';
  public $local_id = '';
  public $title = '';
  public $uri = '';
  public $text = [];
}

/*
$options_code = [
  [ // Папка 1
    'title' => 'Авторизация',
    'items' => [
      [
        'title' => 'Смена адреса электронной почты',
        'code' => ['change_user_email_code', 'confirm_user_email_code', ],
      ],
      [
        'title' => 'Смена пароля',
        'code' => ['change_user_password_code', ],
      ],
      [
        'title' => 'Удаление аккаунта',
        'code' => ['delete_account_code', 'confirm_account_deletion_code', ],
      ],
    ],
  ],
  [ // Папка 2
    'title' => 'Внешний вид',
    'items' => [
      [
        'title' => 'Цветовой фон',
        'code' => ['set_color_code', ],
      ],
      [
        'title' => 'Базовый шрифт',
        'code' => ['set_font_code', ],
      ],
    ],
  ],
  [ // Папка 3
    'title' => 'Фоновый рисунок',
    'items' => [
      [
        'title' => 'Выбрать фоновый рисунок',
        'code' => ['images_collection_code', 'change_background_image_code', ],
      ],
    ],
  ],
];
*/

?>
