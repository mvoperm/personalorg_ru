<?php

/* ПОДЛОЖКИ ДЛЯ СТРАНИЦЫ НАСТРОЕК */

// Массив доступных подложек из коллекции
define('IMAGES_COLLECTION', [
  'im_London_BigBen.jpg',
  //'im_azure.jpg',
  'im_light_clouds-repeat.jpg',
  'im_001-repeat.gif',
  'im_002-repeat.jpg',
  'im_005-repeat.gif',
  'im_006-repeat.jpg',
  'im_008-repeat.jpg',
  'im_011-repeat.jpg',
  'im_012-repeat.jpg',
  'im_021-repeat.jpg',
  'im_022-repeat.jpg',
  'im_023-repeat.jpg',
  'im_024-repeat.jpg',
  'im_025-repeat.jpg',
  'im_026-repeat.jpg',
  'im_027-repeat.jpg',
  'im_028-repeat.gif',
  'im_029-repeat.gif',
  'im_035-repeat.jpg',
  'im_036-repeat.jpg',
  'im_038-repeat.jpg',
  'im_blue_pastels-repeat.jpg',
  'im_brushed_metal-repeat.jpg',
  'im_charcoal-repeat.jpg',
  'im_linen-repeat.jpg',
  'im_purple_daisies-repeat.jpg',
  'im_purple_pastels.jpg',
  'im_sepia_marble-repeat.jpg',
  'im_stucco_color-repeat.jpg',
  'im_wild_red_flowers-repeat.jpg',
  'im_yellow_green_chalk-repeat.jpg',
  'im_yellow_tan_dry_brush-repeat.jpg',
]);

// Код блока выбора подложки для страницы настроек
function get_images_collection_code() {
  $images_collection_length = count(IMAGES_COLLECTION);
  $images_collection_code = "<div id='bg-images-collection'>";
  for ($i = 0; $i < $images_collection_length; $i++) {
    $images_collection_code .= "<figure title='" . IMAGES_COLLECTION[$i] . "' class='fg-images-collection'><img alt=" . IMAGES_COLLECTION[$i] . " src='/bg-images/" . IMAGES_COLLECTION[$i] . "' class='img-images-collection'><figcaption class='image-figcaption-none'>" . IMAGES_COLLECTION[$i] . "</figcaption></figure>";
  }
  $images_collection_code .= "</div>";
  return $images_collection_code;
}

?>
