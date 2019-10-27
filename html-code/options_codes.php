<?php

/* КОДЫ ПЕРЕМЕННЫХ ДЛЯ СТРАНИЦЫ НАСТРОЕК */

// 1) Запрос на изменение адреса электронной почты Пользователя
$change_user_email_code = "
<form class='options-form' action='" . CHANGE_USER_EMAIL_FILEPATH . "' method='POST'>
  <p class='options-par'>
    <label>На указанный адрес будет отправлено электронное письмо с кодом для подтверждения:<br>
      <input type='email' name='new_user_email' required size='45' value=''>
    </label>
    <button class='options-button' type='submit'>Изменить адрес</button>
  </p>
</form>
";

// 2) Подтверждение изменения адреса электронной почты Пользователя
$confirm_user_email_code = "
<form class='options-form' action='" . CONFIRM_NEW_USER_EMAIL_FILEPATH . "' method='POST'>
  <p class='options-par'>
    <label>Пожалуйста, подтвердите новый адрес электронной почты, введя код из письма:<br>
      <input type='text' name='pw_toconfirm_email' required size='45' value=''>
    </label>
    <button class='options-button' type='submit'>Подтвердить адрес</button>
  </p>
</form>
";

// 3) Изменение пароля Пользователя
$change_user_password_code = "
<form class='options-form' action='" . CHANGE_USER_PASSWORD_FILEPATH . "' method='POST'>
  <p class='options-par'>
    <label>Введите новый пароль:<br>
      <input type='password' id='password' name='password' required size='32' minlength='6' maxlength='30' title='Пароль должен содержать от 6 до 30 символов' value=''>
    </label>
    <button class='options-button' type='button' id='toggle-password-type'>Показать пароль</button>
  </p>
  <p class='options-par'>
    <label><input type='checkbox' id='send-to-email' name='send_to_email' checked>
      Отправить электронное письмо с новым паролем
    </label>
  </p>
  <p class='options-par'>
    <button class='options-button' type='submit'>Изменить пароль</button>
  </p>
</form>
";

// 4) Запрос на удаление аккаунта Пользователя
$delete_account_code = "
<form class='options-form' action='" . DELETE_ACCOUNT_FILEPATH . "' method='POST'>
  <p class='options-par'>
    На Ваш адрес электронной почты будет отправлено письмо с кодом для подтверждения удаления аккаунта.<br>
    Аккаунт будет удалён после подтверждения и удаления Вами всей пользовательской информации.<br>
    <button class='options-button' type='submit'>Отправить письмо</button>
  </p>
</form>
";

// 5) Подтверждение удаления аккаунта Пользователя
$confirm_account_deletion_code = "
<form class='options-form' action='" . CONFIRM_ACCOUNT_DELETION_FILEPATH . "' method='POST'>
  <p class='options-par'>
    <label>Пожалуйста, подтвердите удаление аккаунта, введя код из письма:<br>
      <input type='text' name='pw_toconfirm_account_delition' required size='45' value=''>
    </label>
  </p>
  <p class='options-par'>
    <button class='options-button' type='submit'>Подтвердить удаление аккаунта</button>
  </p>
</form>
";

// 6) Установка насыщенности элементов страницы и прозрачности фона Статьи
$set_color_code = "
<form class='options-form' id='set-article-color' action='" . CHANGE_ARTICLE_COLOR_FILEPATH . "' method='POST'>
  <p class='options-par'>
    <label>Насыщенность:
      <input type='range' id='bg-hue' min='0' max='360' step='10' value='" . BASIC_HUE_TEXT . "'>
    </label>
    <label>
      <input type='text' id='bg-hue-value' name='basic_hue' size='5' minlength='1' maxlength='3' value=" . BASIC_HUE_TEXT . ">
      (от 0 до 360)
    </label>
  </p>
  <p class='options-par'>
    <label>Прозрачность:
      <input type='range' id='bg-transparency' min='0' max='100' step='5' value='" . ARTICLE_TRANSPARENCY_TEXT . "'>
    </label>
    <label>
      <input type='text' id='bg-transparency-value' name='article_transparency' size='5' minlength='1' maxlength='3' value='" . ARTICLE_TRANSPARENCY_TEXT . "'>
      (от 0 до 100)
    </label>
  </p>
  <p class='options-par'>
    <input type='text' id='check-bg-color' size='15' value=' Абв, где!'>
  </p>
  <p class='options-par'>
    <label>
      <input type='checkbox' id='ck-article-color' name='ck_article_color' checked>
      Только для этого устройства (при снятом флажке свойство будет установлено для всех устройств кроме тех, для которых оно устанавливалось с данным флажком)
    </label>
  </p>
  <p class='options-par'>
    <label>
      <input type='checkbox' id='ck-article-color-delete' name='ck_article_color_delete'>
      Установить для этого устройства цветовой фон, общий для всех устройств
    </label>
  </p>
  <p class='options-par'>
    <button class='options-button' type='submit'>Изменить цвет</button>
  </p>
</form>
";

// 7) Установка гарнитуры и размера шрифта
$font_types_touse = array(
  'Arial',
  'Verdana',
  'Times New Roman',
  'Courier New',
);
$font_types_options_code = '';
for ($i = 0; $i < count($font_types_touse); $i++) {
  $font_type_selected = ($font_types_touse[$i] === BASIC_FONT_TYPE) ? ' selected' : '';
  $font_types_options_code .= "<option{$font_type_selected} value='{$font_types_touse[$i]}'>{$font_types_touse[$i]}</option>";
}
$set_font_code = "
<form class='options-form' id='set-basic-font' action='" . CHANGE_BASIC_FONT_FILEPATH . "' method='POST'>
  <p class='options-par'>
		<label>Тип базового шрифта:
			<select id='basic-font-type' name='basic_font_type' required size='1'>{$font_types_options_code}</select>
    </label>
  </p>
  <p class='options-par'>
    <label>Размер базового шрифта (px):
      <input type='number' id='basic-font-size' name='basic_font_size' size='5' minlength='1' maxlength='3' min='8' max='36' step='1' value='" . BASIC_FONT_SIZE . "'>
    </label>
  </p>
  <p class='options-par'>
    <input type='text' id='check-basic-font' size='15' value=' Абв, где!'>
  </p>
  <p class='options-par'>
    <label>
      <input type='checkbox' id='ck-basic-font' name='ck_basic_font' checked>
      Только для этого устройства (при снятом флажке свойство будет установлено для всех устройств кроме тех, для которых оно устанавливалось с данным флажком)
    </label>
  </p>
  <p class='options-par'>
    <label>
      <input type='checkbox' id='ck-basic-font-delete' name='ck_basic_font_delete'>
      Установить для этого устройства шрифт, общий для всех устройств
    </label>
  </p>
  <p class='options-par'>
    <button class='options-button' type='submit'>Изменить шрифт</button>
  </p>
</form>
";

// 8) Выбор фонового рисунка страницы контента
$images_collection = array(
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
);
$images_collection_length = count($images_collection);
$images_collection_code = "<div id='bg-images-collection'>";
for ($i = 0; $i < $images_collection_length; $i++) {
  $images_collection_code .= "<figure title={$images_collection[$i]}><img alt={$images_collection[$i]} src='/bg-images/{$images_collection[$i]}'><figcaption class='bg-image-figcaption'>{$images_collection[$i]}</figcaption></figure>";
}
$images_collection_code .= "</div>";

// 9) Установка фонового рисунка страницы контента
$change_background_image_code = "
<form class='options-form' action='" . CHANGE_BACKGROUND_IMAGE_FILEPATH . "' method='POST'>
	<p class='options-par'>
		<label>
			<input type='checkbox' id='delete-bg-image' name='delete_bg_image'>
			Удалить фоновый рисунок
		</label>
	</p>
	<p class='options-par'>
		<label>
			<input type='checkbox' name='ck_bg_image' checked>
			Только для этого устройства
		</label>
	</p>
	<p class='options-par'>
		<label>
			Выбранный файл
			<br>
			<input type='text' id='bg-image-file' name='bg_image_file' size='50' value=''>
		</label>
	</p>
	<p class='options-par'>
		<button class='options-button' type='submit' id='submit-bg-image'>Установить фоновый рисунок</button>
	</p>
</form>
";

?>
