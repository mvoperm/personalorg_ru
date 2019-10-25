<?php

$change_user_email_code = "
<form class='options-form' action=" . CHANGE_USER_EMAIL_FILEPATH . " method='POST'>
  <p class='options-par'>
    <label>На указанный адрес будет отправлено электронное письмо с кодом для подтверждения:<br>
      <input type='email' name='new_user_email' required size='45' value=''>
    </label>
    <button class='options-button' type='submit'>Изменить адрес</button>
  </p>
</form>
";

$confirm_user_email_code = "
<form class='options-form' action=" . CONFIRM_NEW_USER_EMAIL_FILEPATH . " method='POST'>
  <p class='options-par'>
    <label>Пожалуйста, подтвердите новый адрес электронной почты, введя код из письма:<br>
      <input type='text' name='pw_toconfirm_email' required size='45' value=''>
    </label>
    <button class='options-button' type='submit'>Подтвердить адрес</button>
  </p>
</form>
";

$change_user_password_code = "
<form class='options-form' action=" . CHANGE_USER_PASSWORD_FILEPATH . " method='POST'>
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

$delete_account_code = "
<form class='options-form' action=" . DELETE_ACCOUNT_FILEPATH . " method='POST'>
  <p class='options-par'>
    На Ваш адрес электронной почты будет отправлено письмо с кодом для подтверждения удаления аккаунта.<br>
    Аккаунт будет удалён после подтверждения и удаления Вами всей пользовательской информации.<br>
    <button class='options-button' type='submit'>Отправить письмо</button>
  </p>
</form>
";

$confirm_account_deletion_code = "
<form class='options-form' action=" . CONFIRM_ACCOUNT_DELETION_FILEPATH . " method='POST'>
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

$set_color_code = "
<form class='options-form' id='set-article-color' action=" . CHANGE_ARTICLE_COLOR_FILEPATH . " method='POST'>
  <p class='options-par'>
    <label>Насыщенность:
      <input type='range' id='bg-hue' min='0' max='360' step='10' value=" . BASIC_HUE_TEXT . ">
    </label>
    <label>
      <input type='text' id='bg-hue-value' name='basic_hue' size='5' minlength='1' maxlength='3' value=" . BASIC_HUE_TEXT . ">
      (от 0 до 360)
    </label>
  </p>
  <p class='options-par'>
    <label>Прозрачность:
      <input type='range' id='bg-transparency' min='0' max='100' step='5' value=" . ARTICLE_TRANSPARENCY_TEXT . ">
    </label>
    <label>
      <input type='text' id='bg-transparency-value' name='article_transparency' size='5' minlength='1' maxlength='3' value=" . ARTICLE_TRANSPARENCY_TEXT . ">
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

$set_font_code = "
<form class='options-form' id='set-basic-font' action=" . CHANGE_BASIC_FONT_FILEPATH . " method='POST'>
  <p class='options-par'>
		<label>Тип базового шрифта:
			<select id='basic-font-type' name='basic_font_type' required size='1'>
        <option value='Arial'>Arial</option>
        <option value='Verdana'>Verdana</option>
        <option value='Times New Roman'>Times New Roman</option>
        <option value='Courier New'>Courier New</option></select>
    </label>
  </p>
  <p class='options-par'>
    <label>Размер базового шрифта (px):
      <input type='number' id='basic-font-size' name='basic_font_size' size='5' minlength='1' maxlength='3' min='8' max='36' step='1' value=" . BASIC_FONT_SIZE . ">
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

$images_collection_code = <<<EOT
<div id="bg-images-collection">
<figure title="im_London_BigBen.jpg"><img alt="im_London_BigBen.jpg" src="/bg-images/im_London_BigBen.jpg"><figcaption class="bg-image-figcaption">im_London_BigBen.jpg</figcaption></figure><figure title="im_light_clouds-repeat.jpg"><img alt="im_light_clouds-repeat.jpg" src="/bg-images/im_light_clouds-repeat.jpg"><figcaption class="bg-image-figcaption">im_light_clouds-repeat.jpg</figcaption></figure><figure title="im_001-repeat.gif"><img alt="im_001-repeat.gif" src="/bg-images/im_001-repeat.gif"><figcaption class="bg-image-figcaption">im_001-repeat.gif</figcaption></figure><figure title="im_002-repeat.jpg"><img alt="im_002-repeat.jpg" src="/bg-images/im_002-repeat.jpg"><figcaption class="bg-image-figcaption">im_002-repeat.jpg</figcaption></figure><figure title="im_005-repeat.gif"><img alt="im_005-repeat.gif" src="/bg-images/im_005-repeat.gif"><figcaption class="bg-image-figcaption">im_005-repeat.gif</figcaption></figure><figure title="im_006-repeat.jpg"><img alt="im_006-repeat.jpg" src="/bg-images/im_006-repeat.jpg"><figcaption class="bg-image-figcaption">im_006-repeat.jpg</figcaption></figure><figure title="im_008-repeat.jpg"><img alt="im_008-repeat.jpg" src="/bg-images/im_008-repeat.jpg"><figcaption class="bg-image-figcaption">im_008-repeat.jpg</figcaption></figure><figure title="im_011-repeat.jpg"><img alt="im_011-repeat.jpg" src="/bg-images/im_011-repeat.jpg"><figcaption class="bg-image-figcaption">im_011-repeat.jpg</figcaption></figure><figure title="im_012-repeat.jpg"><img alt="im_012-repeat.jpg" src="/bg-images/im_012-repeat.jpg"><figcaption class="bg-image-figcaption">im_012-repeat.jpg</figcaption></figure><figure title="im_021-repeat.jpg"><img alt="im_021-repeat.jpg" src="/bg-images/im_021-repeat.jpg"><figcaption class="bg-image-figcaption">im_021-repeat.jpg</figcaption></figure><figure title="im_022-repeat.jpg"><img alt="im_022-repeat.jpg" src="/bg-images/im_022-repeat.jpg"><figcaption class="bg-image-figcaption">im_022-repeat.jpg</figcaption></figure><figure title="im_023-repeat.jpg"><img alt="im_023-repeat.jpg" src="/bg-images/im_023-repeat.jpg"><figcaption class="bg-image-figcaption">im_023-repeat.jpg</figcaption></figure><figure title="im_024-repeat.jpg"><img alt="im_024-repeat.jpg" src="/bg-images/im_024-repeat.jpg"><figcaption class="bg-image-figcaption">im_024-repeat.jpg</figcaption></figure><figure title="im_025-repeat.jpg"><img alt="im_025-repeat.jpg" src="/bg-images/im_025-repeat.jpg"><figcaption class="bg-image-figcaption">im_025-repeat.jpg</figcaption></figure><figure title="im_026-repeat.jpg"><img alt="im_026-repeat.jpg" src="/bg-images/im_026-repeat.jpg"><figcaption class="bg-image-figcaption">im_026-repeat.jpg</figcaption></figure><figure title="im_027-repeat.jpg"><img alt="im_027-repeat.jpg" src="/bg-images/im_027-repeat.jpg"><figcaption class="bg-image-figcaption">im_027-repeat.jpg</figcaption></figure><figure title="im_028-repeat.gif"><img alt="im_028-repeat.gif" src="/bg-images/im_028-repeat.gif"><figcaption class="bg-image-figcaption">im_028-repeat.gif</figcaption></figure><figure title="im_029-repeat.gif"><img alt="im_029-repeat.gif" src="/bg-images/im_029-repeat.gif"><figcaption class="bg-image-figcaption">im_029-repeat.gif</figcaption></figure><figure title="im_035-repeat.jpg"><img alt="im_035-repeat.jpg" src="/bg-images/im_035-repeat.jpg"><figcaption class="bg-image-figcaption">im_035-repeat.jpg</figcaption></figure><figure title="im_036-repeat.jpg"><img alt="im_036-repeat.jpg" src="/bg-images/im_036-repeat.jpg"><figcaption class="bg-image-figcaption">im_036-repeat.jpg</figcaption></figure><figure title="im_038-repeat.jpg"><img alt="im_038-repeat.jpg" src="/bg-images/im_038-repeat.jpg"><figcaption class="bg-image-figcaption">im_038-repeat.jpg</figcaption></figure><figure title="im_blue_pastels-repeat.jpg"><img alt="im_blue_pastels-repeat.jpg" src="/bg-images/im_blue_pastels-repeat.jpg"><figcaption class="bg-image-figcaption">im_blue_pastels-repeat.jpg</figcaption></figure><figure title="im_brushed_metal-repeat.jpg"><img alt="im_brushed_metal-repeat.jpg" src="/bg-images/im_brushed_metal-repeat.jpg"><figcaption class="bg-image-figcaption">im_brushed_metal-repeat.jpg</figcaption></figure><figure title="im_charcoal-repeat.jpg"><img alt="im_charcoal-repeat.jpg" src="/bg-images/im_charcoal-repeat.jpg"><figcaption class="bg-image-figcaption">im_charcoal-repeat.jpg</figcaption></figure><figure title="im_linen-repeat.jpg"><img alt="im_linen-repeat.jpg" src="/bg-images/im_linen-repeat.jpg"><figcaption class="bg-image-figcaption">im_linen-repeat.jpg</figcaption></figure><figure title="im_purple_daisies-repeat.jpg"><img alt="im_purple_daisies-repeat.jpg" src="/bg-images/im_purple_daisies-repeat.jpg"><figcaption class="bg-image-figcaption">im_purple_daisies-repeat.jpg</figcaption></figure><figure title="im_purple_pastels.jpg"><img alt="im_purple_pastels.jpg" src="/bg-images/im_purple_pastels.jpg"><figcaption class="bg-image-figcaption">im_purple_pastels.jpg</figcaption></figure><figure title="im_sepia_marble-repeat.jpg"><img alt="im_sepia_marble-repeat.jpg" src="/bg-images/im_sepia_marble-repeat.jpg"><figcaption class="bg-image-figcaption">im_sepia_marble-repeat.jpg</figcaption></figure><figure title="im_stucco_color-repeat.jpg"><img alt="im_stucco_color-repeat.jpg" src="/bg-images/im_stucco_color-repeat.jpg"><figcaption class="bg-image-figcaption">im_stucco_color-repeat.jpg</figcaption></figure><figure title="im_wild_red_flowers-repeat.jpg"><img alt="im_wild_red_flowers-repeat.jpg" src="/bg-images/im_wild_red_flowers-repeat.jpg"><figcaption class="bg-image-figcaption">im_wild_red_flowers-repeat.jpg</figcaption></figure><figure title="im_yellow_green_chalk-repeat.jpg"><img alt="im_yellow_green_chalk-repeat.jpg" src="/bg-images/im_yellow_green_chalk-repeat.jpg"><figcaption class="bg-image-figcaption">im_yellow_green_chalk-repeat.jpg</figcaption></figure><figure title="im_yellow_tan_dry_brush-repeat.jpg"><img alt="im_yellow_tan_dry_brush-repeat.jpg" src="/bg-images/im_yellow_tan_dry_brush-repeat.jpg"><figcaption class="bg-image-figcaption">im_yellow_tan_dry_brush-repeat.jpg</figcaption></figure>
</div>
EOT;

$change_background_image_code = "
<form class='options-form' action=" . CHANGE_BACKGROUND_IMAGE_FILEPATH . " method='POST'>

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
