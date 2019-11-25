<?php

/* Отображение перечня доступных сервисов */

$contents_list_code = '';
for ($i = 0; $i < (CONTENT_LIST_LENGHT - 1); $i++) {
  $contents_list_li_class = ($contentslist[$i] === $content) ? "header-contents-list-li header-contents-list-li-current" : "header-contents-list-li";
  $contents_list_code .= "
  <li class='{$contents_list_li_class}'>
    <a href='" . DOMAIN_URI . "/content.php?content={$contentslist[$i]}'>{${$contentslist[$i]}[1]}</a>
  </li>
  ";
}

?>
