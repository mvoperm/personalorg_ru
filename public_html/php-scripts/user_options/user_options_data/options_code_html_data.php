<?php

/* ДАННЫЕ ДЛЯ HTML-КОДА СТРАНИЦЫ НАСТРОЕК */

function get_default_options()	{ /* Определяет массив имеющихся настоек пользователя, чтобы вставить его значения в случае отсутствия куки */
	$content_def_filepath = USERS_DIR . 'optionslist_default.json';
	$content_filepath = USERS_DIR . USER_FOLDER . '/optionslist.json';
	$json_file_default = file_get_contents($content_def_filepath); // Получение содержимого файла
	$json_file_user = file_get_contents($content_filepath);
	$json_obj_default = json_decode($json_file_default, true); // Формирование объекта
	$json_obj_user = json_decode($json_file_user, true);
	for ($i = 0; $i < USER_OPTIONS_CONSTANTS_LIST_LENGTH; $i++)	{
		$option_key = USER_OPTIONS_CONSTANTS_LIST[$i][0];
		$option_value = (isset($json_obj_user[$option_key])) ? $json_obj_user[$option_key] : $json_obj_default[$option_key];
		define(USER_OPTIONS_CONSTANTS_LIST[$i][2], $option_value);
	}
}
get_default_options();

for ($i = 0; $i < USER_OPTIONS_CONSTANTS_LIST_LENGTH; $i++) {
  $cookie_title = USER_ID . '_' . USER_OPTIONS_CONSTANTS_LIST[$i][0];
  define(USER_OPTIONS_CONSTANTS_LIST[$i][1], isset($_COOKIE[$cookie_title]) ? $_COOKIE[$cookie_title] : constant(USER_OPTIONS_CONSTANTS_LIST[$i][2]));
  //echo $cookie_title . ' = ' . ($_COOKIE[$cookie_title] ?? 'null') . '<br>';
}

define('USER_OPTIONS_CODE_ARRAY', [
  // Страница 1
  ['Авторизация', [
    ['Смена адреса электронной почты',
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
    ['Смена пароля',
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
    ['Удаление аккаунта',
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
    ['Цветовой фон',
      "
      <form class='inblock-form' id='set-article-color' action='" . CHANGE_STYLES_OPTIONS_FILEPATH . "' method='POST'>
        <p class='text-input-p' style='display:none;'>
          <label>Параметр для обработки формы
            <input type='text' name='option_number' value='0'>
          </label>
        </p>
        <p class='text-input-p'>
          <label>Насыщенность:
            <input type='range' id='bg-hue' min='0' max='360' step='10' value='" . constant(USER_OPTIONS_CONSTANTS_LIST[0][1]) . "'>
          </label>
          <label>
            <input type='text' id='bg-hue-value' name='" . USER_OPTIONS_CONSTANTS_LIST[0][0] . "' class='input-number' size='5' minlength='1' maxlength='3' value=" . constant(USER_OPTIONS_CONSTANTS_LIST[0][1]) . ">
            (от 0 до 360)
          </label>
        </p>
        <p class='text-input-p'>
          <label>Прозрачность:
            <input type='range' id='bg-transparency' min='0' max='100' step='5' value='" . constant(USER_OPTIONS_CONSTANTS_LIST[1][1]) . "'>
          </label>
          <label>
            <input type='text' id='bg-transparency-value' name='" . USER_OPTIONS_CONSTANTS_LIST[1][0] . "' class='input-number' size='5' minlength='1' maxlength='3' value='" . constant(USER_OPTIONS_CONSTANTS_LIST[1][1]) . "'>
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
    ['Базовый шрифт',
      "
      <form class='inblock-form' id='set-basic-font' action='" . CHANGE_STYLES_OPTIONS_FILEPATH . "' method='POST'>
        <p class='text-input-p' style='display:none;'>
          <label>Параметр для обработки формы
            <input type='text' name='option_number' value='1'>
          </label>
        </p>
        <p class='text-input-p'>
      		<label>Тип базового шрифта:
      			<select id='basic-font-type' name='basic_font_type' required size='1'>" . get_font_types_options_code() . "</select>
          </label>
        </p>
        <p class='text-input-p'>
          <label>Размер базового шрифта (px):
            <input type='number' id='basic-font-size' name='basic_font_size' class='input-number' size='5' minlength='1' maxlength='3' min='8' max='36' step='1' value='" . constant(USER_OPTIONS_CONSTANTS_LIST[3][1]) . "'>
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
    ['Выбрать фоновый рисунок',
      get_images_collection_code() . "
      <form class='inblock-form' action='" . CHANGE_STYLES_OPTIONS_FILEPATH . "' method='POST'>
        <p class='text-input-p' style='display:none;'>
          <label>Параметр для обработки формы
            <input type='text' name='option_number' value='2'>
          </label>
        </p>
      	<p class='checkbox-p'>
      		<label>
      			<input type='checkbox' id='delete-bg-image' name='delete_bg_image'>
      			<span class='check-span'>Удалить фоновый рисунок</span>
      		</label>
      	</p>
      	<p class='checkbox-p'>
      		<label>
      			<input type='checkbox' id='ck-bg-image' name='ck_bg_image' checked>
      			<span class='check-span'>Только для этого устройства (при снятом флажке свойство будет установлено для всех устройств кроме тех, для которых оно устанавливалось с данным флажком)</span>
      		</label>
      	</p>
        <p class='checkbox-p'>
          <label>
            <input type='checkbox' id='ck-bg-image-delete' name='ck_bg_image_delete'>
            <span class='check-span'>Установить для этого устройства фоновый рисунок, общий для всех устройств</span>
          </label>
        </p>
      	<p class='text-input-p'>
      		<label>
      			Выбранный файл
      			<br>
      			<input type='text' id='bg-image-file' name='bg_image' size='50' value=''>
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

?>
