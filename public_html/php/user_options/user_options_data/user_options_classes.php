<?php

/* ОБЪЯВЛЕНИЕ КЛАССОВ БЛОКА НАСТРОЕК ПОЛЬЗОВАТЕЛЯ */

class UserOptions {
  public $options_pages = [];
}

class UserOptionsPage {
  public $title = '';
  public $options_groups = [];
}

class UserOptionsGroup {
  public $title = '';
  public $name = '';
  public $options = [];
  public $html_code = '';
}

class UserOption {
  public $name = '';
  public $constant = '';
}

?>
