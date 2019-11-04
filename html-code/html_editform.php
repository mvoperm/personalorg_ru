<?php

/* HTML-КОД ФОРМЫ РЕДАКТИРОВАНИЯ КОНТЕНТА ПОЛЬЗОВАТЕЛЯ */

$html_editform = '';
if ($content !== "options")	{ // Для страницы настроек не загружается

	// Вспомогательные переменные
	$uri_display_style = ($content === "bookmarks") ? "" : " style='display: none;'";
	$item_text_html = ($content === "notes") ?
			"Текст<br><textarea id='editform-item-text' name='item_text' class='input-enabled' rows='12' placeholder='Текст'></textarea>" :
			"Комментарий<br><input id='editform-item-text' name='item_text' type='text' class='input-line input-enabled' placeholder='Текст' value=''>";

	// Html-код формы
	$html_editform = "
	<dialog id='editform'>
		<form method='post' id='editform-form' action='" . EDIT_CONTENT_FILEPATH . "'>
			<!-- Служебная информация (не отображается) -->
			<p class='editform-meta'>
				<label>Тип контента
					<input id='editform-content-name' name='content_name' type='text' class='readonly' tabindex='-1' readonly value='{$content}'>
				</label>
			</p>
			<p class='editform-meta'>
				<label>Id текущей папки
					<input id='editform-currentfolder-idtotal' name='currentfolder_idtotal' type='text' class='readonly' tabindex='-1' size='5' readonly value=''>
				</label>
			</p>
			<p class='editform-meta'>
				<label>Id родителя текущего элемента
					<input id='editform-currentparent-idtotal' name='currentparent_idtotal' type='text' class='readonly' tabindex='-1' size='5' readonly value=''>
				</label>
			</p>
			<p class='editform-meta'>
				<label>Id локальный
					<input id='editform-idlocal' name='item_idlocal' type='text' class='readonly' tabindex='-1' size='3' readonly value=''>
				</label>
			</p>
			<p class='editform-meta'>
				<label>Элемент к редактированию
					<input id='editform-element-toedit-type' name='element_toedit_type' type='text' class='readonly' tabindex='-1' size='8' readonly value=''>
				</label>
			</p>
			<p class='editform-meta'>
				<label>Тип редактирования папки / {${$content}[2]}
					<input id='editform-element-edit-type' name='element_edit_type' type='text' class='readonly' tabindex='-1' size='8' readonly value=''>
				</label>
			</p>
			<!-- Заголовок формы -->
			<h4 id='editform-title'></h4>
			<!-- Элементы для редактирования -->
			<p class='editform-edit'>
				<label>Заголовок<br>
					<input id='editform-element-title' name='element_title' type='text' class='input-line input-enabled' autofocus placeholder='Заголовок' value=''>
				</label>
			</p>
			<p id='editform-item-par-uri' class='editform-edit'{$uri_display_style}>
				<label>URI закладки<br>
					<input id='editform-item-uri' name='item_uri' type='url' class='input-line input-enabled' placeholder='https://example.com' value=''>
				</label>
			</p>
			<p id='editform-item-par-text' class='editform-edit'>
				<label>{$item_text_html}</label>
			</p>
			<!-- Элементы для перемещения -->
			<fieldset id='relocation-type' class='editform-relocate'>
				<legend>Тип перемещения</legend>
				<p class='checkbox-radio-par'>
					<label>
						<input id='editform-infolder-radio' name='relocation_type' type='radio' autofocus checked value='in_folder'>
						<span class='check-span'> в пределах папки</span>
					</label>
				</p>
				<p class='checkbox-radio-par'>
					<label>
						<input id='editform-outfolder-radio' name='relocation_type' type='radio' value='out_folder'>
						<span class='check-span'> в другую папку</span>
					</label>
				</p>
				<fieldset id='relocation-tree'>
					<legend>Папка для перемещения</legend>
					{$user_content_html[2]}
				</fieldset>
			</fieldset>
			<fieldset id='relocation-order-number' class='editform-relocate-add'>
				<legend>Точка перемещения</legend>
				<p class='checkbox-radio-par'>
					<label>
						<input id='editform-firstordernumber-radio' name='relocation_order_number' type='radio' autofocus checked value='first'>
						<span class='check-span'> в начало папки</span>
					</label>
				</p>
				<p class='checkbox-radio-par'>
					<label>
						<input id='editform-lastordernumber-radio' name='relocation_order_number' type='radio' value='last'>
						<span class='check-span'> в конец папки</span>
					</label>
				</p>
				<p class='checkbox-radio-par'>
					<label>
						<input id='editform-setordernumber-radio' name='relocation_order_number' type='radio' value='set_order_number'>
						<span class='check-span'> задать порядковый номер </span>
					</label>
					<label>
						<span style='display:none;'>порядковый номер</span>
						<input id='relocation-order-setnumber' name='relocation_order_setnumber' type='number' class='input-number input-enabled' tabindex='-1' size='2' value='1' min='1' max='1' step='1' />
					</label>
				</p>
				<p class='maxordernumber-input'>
					<label>(максимальный порядковый номер
						<input id='editform-maxordernumber' name='relocation_maxordernumber' type='text' class='readonly input-number' tabindex='-1' size='2' readonly value=''> )
					</label>
				</p>
				<p class='editform-relocate-meta'>
					<label>Наличие папок в папке назначения:
						<input id='editform-has-folders' name='has_folders' type='text' class='readonly' tabindex='-1' size='5' readonly value=''>
					</label>
				</p>
				<p class='editform-relocate-meta'>
					<label>Наличие статей в папке назначения:
						<input id='editform-has-items' name='has_items' type='text' class='readonly' tabindex='-1' size='5' readonly='readonly' value=''>
					</label>
				</p>
			</fieldset>
			<p class='editform-meta'>
				<label>Id (назначения) родителя
					<input id='editform-parentfolder-idtotal' name='parentfolder_idtotal' type='text' class='readonly' tabindex='-1' size='5' readonly='readonly' value=''>
				</label>
			</p>
			<p class='editform-meta'>
				<label>Папка (результирующая) к отображению:
					<input id='editform-folder-tooppen' name='folder_tooppen' type='text' class='readonly' tabindex='-1' size='5' readonly='readonly' value=''>
				</label>
			</p>
			<!-- Кнопки -->
			<p class='submit-buttons'>
				<button type='submit' id='submit'>OK</button>
				<button type='button' id='cancel'>Отмена</button>
			</p>
		</form>
	</dialog>
	";
}

?>
