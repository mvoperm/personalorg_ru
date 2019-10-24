<?php

class Folder {
  public $title = '';
  public $parent_id = '';
  public $local_id = '';
  public $folders = array();
  public $items = array();
  public function get_total_id() {
    $total_id = ($this -> local_id === '0' || $this -> parent_id === '0') ? $this -> local_id : $this -> parent_id . '-' . $this -> local_id ;
    return $total_id;
  }
  public function has_sub_folders() {
    return count($this -> folders) > 0;
  }
}

/*
$new_folder = new Folder();
//array_push($new_folder -> folders, new Folder());
echo (integer) $new_folder -> has_sub_folders();
exit();
*/

class Item {
  public $parent_id = '';
  public $local_id = '';
  public $title = '';
  public $uri = '';
  public $text = array();
}

?>
