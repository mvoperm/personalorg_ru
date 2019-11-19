<?php

/* 1. ОБЪЯВЛЕНИЕ КЛАССОВ */
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


/* 2. СОЗДАНИЕ КОНСТАНТЫ МАССИВА НАСТРОЕК ПОЛЬЗОВАТЕЛЯ */
require_once(DOMAIN_ROOT . CHANGE_USER_OPTIONS_FILEPATH); // Файл с константами путей к требуемым файлам php-скриптов

define('USER_OPTIONS_CONSTANTS_LIST', [
  BASIC_HUE_TEXT,
  ARTICLE_TRANSPARENCY_TEXT,
  BASIC_FONT_TYPE,
  BASIC_FONT_SIZE,
  BG_IMAGE_FILE,
]);

define('FONT_TYPES_TOUSE', ['Arial', 'Verdana', 'Times New Roman', 'Courier New', ]);

function get_font_types_options_code() {
  $font_types_options_code = '';
  for ($i = 0; $i < count(FONT_TYPES_TOUSE); $i++) {
    $font_type_selected = (FONT_TYPES_TOUSE[$i] === USER_OPTIONS_CONSTANTS_LIST[2]) ? ' selected' : '';
    $font_types_options_code .= "<option{$font_type_selected} value='" . FONT_TYPES_TOUSE[$i] . "'>" . FONT_TYPES_TOUSE[$i] . "</option>";
  }
  return $font_types_options_code;
}


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
function get_images_collection_code() {
  $images_collection_length = count(IMAGES_COLLECTION);
  $images_collection_code = "<div id='bg-images-collection'>";
  for ($i = 0; $i < $images_collection_length; $i++) {
    $images_collection_code .= "<figure title='" . IMAGES_COLLECTION[$i] . "' class='fg-images-collection'><img alt=" . IMAGES_COLLECTION[$i] . " src='/bg-images/" . IMAGES_COLLECTION[$i] . "' class='img-images-collection'><figcaption class='image-figcaption-none'>" . IMAGES_COLLECTION[$i] . "</figcaption></figure>";
  }
  $images_collection_code .= "</div>";
  return $images_collection_code;
}

define('USER_OPTIONS_ARRAY', [
  // Страница 1
  ['Авторизация', [
    ['Смена адреса электронной почты', '',
      [],
      "
      <form class='inblock-form' action='" . CHANGE_USER_EMAIL_FILEPATH . "' method='POST'>
        <p class='text-input-p'>
          <label>На указанный адрес будет отправлено электронное письмо с кодом для подтверждения:<br>
            <input type='email' name='new_user_email' required size='45' value=''>
          </label>
        </p>
        <p>
          <button type='submit'>Изменить адрес</button>
        </p>
      </form>
      <form class='inblock-form' action='" . CONFIRM_NEW_USER_EMAIL_FILEPATH . "' method='POST'>
        <p class='text-input-p'>
          <label>Пожалуйста, подтвердите новый адрес электронной почты, введя код из письма:<br>
            <input type='text' name='pw_toconfirm_email' required size='45' value=''>
          </label>
        </p>
        <p>
          <button type='submit'>Подтвердить адрес</button>
        </p>
      </form>
      ",
    ],
    ['Смена пароля', '',
      [],
      "
      <form class='inblock-form' action='" . CHANGE_USER_PASSWORD_FILEPATH . "' method='POST'>
        <p class='text-input-p'>
          <label>Введите новый пароль:<br>
            <input type='password' id='password' name='password' required size='32' minlength='6' maxlength='30' title='Пароль должен содержать от 6 до 30 символов' value=''>
          </label>
          <button class='auxiliary-button' type='button' id='toggle-password-type'>Показать пароль</button>
        </p>
        <p class='checkbox-p'>
          <label><input type='checkbox' id='send-to-email' name='send_to_email' checked>
            <span class='check-span'>Отправить электронное письмо с новым паролем</span>
          </label>
        </p>
        <p>
          <button type='submit'>Изменить пароль</button>
        </p>
      </form>
      ",
    ],
    ['Удаление аккаунта', '',
      [],
      "
      <form class='inblock-form' action='" . DELETE_ACCOUNT_FILEPATH . "' method='POST'>
        <p>На Ваш адрес электронной почты будет отправлено письмо с кодом для подтверждения удаления аккаунта.<br>
          Аккаунт будет удалён после подтверждения и удаления Вами всей пользовательской информации.<br>
          <button type='submit'>Отправить письмо</button>
        </p>
      </form>
      <form class='inblock-form' action='" . CONFIRM_ACCOUNT_DELETION_FILEPATH . "' method='POST'>
        <p class='text-input-p'>
          <label>Пожалуйста, подтвердите удаление аккаунта, введя код из письма:<br>
            <input type='text' name='pw_toconfirm_account_delition' required size='45' value=''>
          </label>
        </p>
        <p>
          <button type='submit'>Подтвердить удаление аккаунта</button>
        </p>
      </form>
      ",
    ],
  ]],

  // Страница 2
  ['Внешний вид', [
    ['Цветовой фон', 'article_color',
      [
        ['basic_hue', USER_OPTIONS_CONSTANTS_LIST[0]],
        ['article_transparency', USER_OPTIONS_CONSTANTS_LIST[1]],
      ],
      "
      <form class='inblock-form' id='set-article-color' action='" . CHANGE_ARTICLE_COLOR_FILEPATH . "' method='POST'>
        <p class='text-input-p'>
          <label>Насыщенность:
            <input type='range' id='bg-hue' min='0' max='360' step='10' value='" . USER_OPTIONS_CONSTANTS_LIST[0] . "'>
          </label>
          <label>
            <input type='text' id='bg-hue-value' name='basic_hue' class='input-number' size='5' minlength='1' maxlength='3' value=" . USER_OPTIONS_CONSTANTS_LIST[0] . ">
            (от 0 до 360)
          </label>
        </p>
        <p class='text-input-p'>
          <label>Прозрачность:
            <input type='range' id='bg-transparency' min='0' max='100' step='5' value='" . USER_OPTIONS_CONSTANTS_LIST[1] . "'>
          </label>
          <label>
            <input type='text' id='bg-transparency-value' name='article_transparency' class='input-number' size='5' minlength='1' maxlength='3' value='" . USER_OPTIONS_CONSTANTS_LIST[1] . "'>
            (от 0 до 100)
          </label>
        </p>
        <p class='text-input-p'>
          <input type='text' id='check-bg-color' size='15' value=' Абв, где!'>
        </p>
        <p class='checkbox-p'>
          <label>
            <input type='checkbox' id='ck-article-color' name='ck_article_color' checked>
            <span class='check-span'>Только для этого устройства (при снятом флажке свойство будет установлено для всех устройств кроме тех, для которых оно устанавливалось с данным флажком)</span>
          </label>
        </p>
        <p class='checkbox-p'>
          <label>
            <input type='checkbox' id='ck-article-color-delete' name='ck_article_color_delete'>
            <span class='check-span'>Установить для этого устройства цветовой фон, общий для всех устройств</span>
          </label>
        </p>
        <p>
          <button type='submit'>Изменить цвет</button>
        </p>
      </form>
      ",
    ],
    ['Базовый шрифт', 'basic_font',
      [
        ['basic_font_type', USER_OPTIONS_CONSTANTS_LIST[2]],
        ['basic_font_size', USER_OPTIONS_CONSTANTS_LIST[3]],
      ],
      "
      <form class='inblock-form' id='set-basic-font' action='" . CHANGE_BASIC_FONT_FILEPATH . "' method='POST'>
        <p class='text-input-p'>
      		<label>Тип базового шрифта:
      			<select id='basic-font-type' name='basic_font_type' required size='1'>" . get_font_types_options_code() . "</select>
          </label>
        </p>
        <p class='text-input-p'>
          <label>Размер базового шрифта (px):
            <input type='number' id='basic-font-size' name='basic_font_size' class='input-number' size='5' minlength='1' maxlength='3' min='8' max='36' step='1' value='" . USER_OPTIONS_CONSTANTS_LIST[3] . "'>
          </label>
        </p>
        <p class='checkbox-p'>
          <input type='text' id='check-basic-font' size='15' value=' Абв, где!'>
        </p>
        <p class='checkbox-p'>
          <label>
            <input type='checkbox' id='ck-basic-font' name='ck_basic_font' checked>
            <span class='check-span'>Только для этого устройства (при снятом флажке свойство будет установлено для всех устройств кроме тех, для которых оно устанавливалось с данным флажком)</span>
          </label>
        </p>
        <p class='checkbox-p'>
          <label>
            <input type='checkbox' id='ck-basic-font-delete' name='ck_basic_font_delete'>
            <span class='check-span'>Установить для этого устройства шрифт, общий для всех устройств</span>
          </label>
        </p>
        <p>
          <button type='submit'>Изменить шрифт</button>
        </p>
      </form>
      ",
    ],
  ]],

  // Страница 3
  ['Фоновый рисунок', [
    ['Выбрать фоновый рисунок', 'bg_image',
      [
        ['bg_image', USER_OPTIONS_CONSTANTS_LIST[4], false]
      ],
      get_images_collection_code() . "
      <form class='inblock-form' action='" . CHANGE_BACKGROUND_IMAGE_FILEPATH . "' method='POST'>
      	<p class='checkbox-p'>
      		<label>
      			<input type='checkbox' id='delete-bg-image' name='delete_bg_image'>
      			<span class='check-span'>Удалить фоновый рисунок</span>
      		</label>
      	</p>
      	<p class='checkbox-p'>
      		<label>
      			<input type='checkbox' name='ck_bg_image' checked>
      			<span class='check-span'>Только для этого устройства</span>
      		</label>
      	</p>
      	<p class='text-input-p'>
      		<label>
      			Выбранный файл
      			<br>
      			<input type='text' id='bg-image-file' name='bg_image_file' size='50' value=''>
      		</label>
      	</p>
      	<p>
      		<button type='submit' id='submit-bg-image'>Установить фоновый рисунок</button>
      	</p>
      </form>
      ",
    ],
  ]],

]);


/* 3. ФОРМИРОВАНИЕ ОБЪЕКТА НАСТРОЕК ПОЛЬЗОВАТЕЛЯ */
function get_user_options_object() { // Создание Объекта UserOptions (существует в единственном экземпляре)
  $user_options_obj = new UserOptions;
  for ($i = 0; $i < count(USER_OPTIONS_ARRAY); $i++) { // Создание Объектов UserOptionsPage и добавление их к Объекту UserOptions
    $options_page_obj = new UserOptionsPage;
    $options_page_obj -> title = USER_OPTIONS_ARRAY[$i][0];
    for ($j = 0; $j < count(USER_OPTIONS_ARRAY[$i][1]); $j++) { // Создание Объектов UserOptionsGroup и добавление их к Объекту UserOptionsPage
      $options_group_obj = new UserOptionsGroup;
      $options_group_obj -> title = USER_OPTIONS_ARRAY[$i][1][$j][0];
      $options_group_obj -> name = USER_OPTIONS_ARRAY[$i][1][$j][1];
      $options_group_obj -> html_code = USER_OPTIONS_ARRAY[$i][1][$j][3];
      if (USER_OPTIONS_ARRAY[$i][1][$j][2]) {
        for ($k = 0; $k < count(USER_OPTIONS_ARRAY[$i][1][$j][2]); $k++) { // Создание Объектов UserOption и добавление их к Объекту UserOptionsGroup
          $option_obj = new UserOption;
          $option_obj -> name = USER_OPTIONS_ARRAY[$i][1][$j][2][$k][0];
          $option_obj -> constant = USER_OPTIONS_ARRAY[$i][1][$j][2][$k][1];
          array_push($options_group_obj -> options, $option_obj);
        }
      }
      array_push($options_page_obj -> options_groups, $options_group_obj);
    }
    array_push($user_options_obj -> options_pages, $options_page_obj);
  }
  return $user_options_obj;
}


/* 4. ИЗМЕНЕНИЕ НАСТРОЕК */



?>
