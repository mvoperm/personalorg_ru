<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 03. Разметка основных отображаемых блоков -->
<xsl:template match='content'>
	<!-- ШАПКА ОКНА -->
	<header class='body-header'>
		<h1>Персональный онлайн-органайзер</h1>
		<div id='headermenu'><!-- меню шапки -->
			<nav><!-- перечень сервисов -->
				<ul class='header-listcontent-ul'>
					<xsl:for-each select='document("contentslist.xml")/contentslist/content'>
						<li class='header-listcontent-li'>
							<xsl:variable name='varCurrentContentName' select='name' />
							<xsl:if test='$varCurrentContentName=$varContentName'><!-- Текущему сервису присваивается дополнительный класс для специального форматирования -->
								<xsl:attribute name='class'><xsl:text>header-listcontent-li header-listcontent-li-current</xsl:text></xsl:attribute>
							</xsl:if>
							<a>
								<xsl:attribute name='href'>
									<xsl:value-of select='$varDomainUri' />
									<xsl:text>/content.php?content=</xsl:text>
									<xsl:value-of select='name' />
								</xsl:attribute>
								<xsl:value-of select='title' />
							</a>
						</li>
					</xsl:for-each>
				</ul>
			</nav>
			<details class='header-menu'><!-- меню аккаунта -->
				<summary class='header-menu-summary'><!-- видимая часть меню аккаунта -->
					<xsl:value-of select='$varUserEmail' /><!--xsl:text>example@gmail.com</xsl:text-->
					<xsl:text> (id = </xsl:text>
					<xsl:value-of select='$varUserId' /><!--xsl:text>000</xsl:text-->
					<xsl:text>)</xsl:text>
				</summary>
				<nav class='header-menu-subdetails'><!-- раскрываемая часть меню аккаунта -->
					<xsl:if test='$varUserId=-1'>
						<div class='header-menu-subitem'><!-- пункт раскрываемой части меню аккаунта -->
							<form id='test-mode-form' method='post'>
								<xsl:attribute name='action'>
									<xsl:value-of select='$varToggleTestModeFilepath' />
								</xsl:attribute>
								<button type='submit' name='toggle-test-mode' id='test-mode-button'>
									<xsl:choose>
										<xsl:when test='$varTestMode=1'><xsl:text>Обычный режим</xsl:text></xsl:when>
										<xsl:otherwise><xsl:text>Тестовый режим</xsl:text></xsl:otherwise>
									</xsl:choose>
								</button>
							</form>
						</div>
						<p class='header-menu-subitem test-mode'><a target='_blank'><!-- пункт раскрываемой части меню аккаунта -->
							<xsl:attribute name='href'>
								<xsl:value-of select='$varDomainUri' />
								<xsl:value-of select='$varTestScreenFilepath' />
							</xsl:attribute>
							<xsl:text>Свойства экрана [&#8663;]</xsl:text>
						</a></p>
					</xsl:if>
					<xsl:if test='not($varContentName="options")'>
						<p class='header-menu-subitem'><a><!-- пункт раскрываемой части меню аккаунта -->
							<xsl:attribute name='href'>
								<xsl:value-of select='$varDomainUri' />
								<xsl:value-of select='$varUserOptionsFilepath' />
							</xsl:attribute>
							<xsl:text>Настройки</xsl:text>
						</a></p>
					</xsl:if>
					<p class='header-menu-subitem'><a target='_blank'><!-- пункт раскрываемой части меню аккаунта -->
						<xsl:attribute name='href'>
							<xsl:value-of select='$varDomainUri' />
							<xsl:value-of select='$varAboutFilepath' />
						</xsl:attribute>
						<xsl:text>О сервисе [&#8663;]</xsl:text>
					</a></p>
					<p class='header-menu-subitem'><a><!-- пункт раскрываемой части меню аккаунта -->
						<xsl:attribute name='href'>
							<xsl:value-of select='$varDomainUri' />
							<xsl:value-of select='$varUserSignoutFilepath' />
						</xsl:attribute>
						<xsl:text>Выход</xsl:text>
					</a></p>
				</nav>
			</details>
		</div>
	</header>
	<!-- ОСНОВНАЯ ЧАСТЬ ОКНА -->
	<main>
		<!-- (1) Дерево папок -->
		<section id='folderstree'>
			<nav>
				<details open='open'><!-- Элемент является модифицированной копией Раздела 04. для корневой папки -->
					<xsl:attribute name='class'>
						<xsl:if test='count(folder) > 0'>
							<xsl:text>subfolders </xsl:text>
						</xsl:if>
						<xsl:text>root-folderstree-details</xsl:text>
					</xsl:attribute>
					<summary class='folderstree-summary' data-folder-idtotal='0'>
						<xsl:value-of select='$varContentTitle' />
					</summary>
					<xsl:apply-templates select='folder' mode='tree' /><!-- Раздел 04. -->
				</details>
			</nav>
		</section>
		<!-- (2) Отображаемая папка -->
		<section id='items'>
			<section class='itemsfolder' data-folder-idtotal='0'><!-- Элемент является модифицированной копией Раздела 05. для корневой папки -->
				<!-- Шапка блока items корневой папки -->
				<header>
					<div>
						<button class='toggle-folderstree-button'>&#9776;</button>
					</div>
					<div class='items-header'>
						<!-- Заголовок -->
						<h2 class='items-h2'>
							<xsl:value-of select='$varContentTitle' />
						</h2>
						<!-- Меню для редактирования -->
						<xsl:if test='not($varContentName="options")'>
							<details class='editmenu'>
								<summary title='Меню' class='editmenu-summary'>
									<xsl:text>&#65049;</xsl:text>
								</summary>
								<menu class='editmenu-subdetails'>
									<p class='command-button'><button class='editmenu-button' data-edit-type='add' data-element-toedit-type='item'>
										<xsl:text>Добавить </xsl:text>
										<xsl:value-of select='$varContentTitleAccusative' />
									</button></p>
									<p class='command-button'><button class='editmenu-button' data-edit-type='add' data-element-toedit-type='folder'>Добавить папку</button></p>
								</menu>
							</details>
						</xsl:if>
					</div>
				</header>
				<!-- Содержание блока items корневой папки -->
				<xsl:apply-templates select='item' /><!-- Раздел 07. -->
			</section>
			<!-- Содержание блока items для всех папок, кроме корневой -->
			<xsl:apply-templates select='//folder' mode='items' /><!-- Раздел 05. -->
		</section>
		<!-- (3)Диалоговая форма для редактирования -->
		<xsl:if test='not($varContentName="options")'>
			<dialog id='editform'>
				<form method='post' id='editform-form'>
					<xsl:attribute name='action'>
						<xsl:value-of select='$varEditContentFilepath' />
					</xsl:attribute>
					<!-- Служебная информация (не отображается) -->
					<p class='editform-meta'>
						<label>
							<xsl:text>Тип контента </xsl:text>
							<input id='editform-content-name' name='content_name' type='text' readonly='readonly'>
								<xsl:attribute name='value'>
									<xsl:value-of select='$varContentName' />
								</xsl:attribute>
							</input>
						</label>
					</p>
					<p class='editform-meta'>
						<label>
							<xsl:text>Id текущей папки </xsl:text>
							<input id='editform-currentfolder-idtotal' name='currentfolder_idtotal' type='text' size='5' readonly='readonly' value='' />
						</label>
					</p>
					<p class='editform-meta'>
						<label>
							<xsl:text>Id родителя текущего элемента </xsl:text>
							<input id='editform-currentparent-idtotal' name='currentparent_idtotal' type='text' size='5' readonly='readonly' value='' />
						</label>
					</p>
					<p class='editform-meta'>
						<label>
							<xsl:text>Id локальный </xsl:text>
							<input id='editform-idlocal' name='item_idlocal' type='text' size='3' readonly='readonly' value='' />
						</label>
					</p>
					<p class='editform-meta'>
						<label>
							<xsl:text>Элемент к редактированию </xsl:text>
							<input id='editform-element-toedit-type' name='element_toedit_type' type='text' size='8' readonly='readonly' value='' />
						</label>
					</p>
					<p class='editform-meta'>
						<label>
							<xsl:text>Тип редактирования папки/</xsl:text>
							<xsl:value-of select='$varContentTitleGenitive' />
							<xsl:text> </xsl:text>
							<input id='editform-element-edit-type' name='element_edit_type' type='text' size='8' readonly='readonly' value='' />
						</label>
					</p>
					<!-- Заголовок формы -->
					<h4 id='editform-title'></h4>
					<!-- Элементы для редактирования -->
					<p class='editform-edit'>
						<label>
							<xsl:text>Заголовок</xsl:text>
							<br />
							<input id='editform-element-title' name='element_title' type='text' autofocus='autofocus' placeholder='Заголовок' value='' />
						</label>
					</p>
					<p id='editform-item-par-uri' class='editform-edit'>
						<xsl:if test='not($varContentName="bookmarks")'><!-- Если сервис не "Закладки", то данный параграф не отображается в любом случае -->
							<xsl:attribute name='style'><xsl:text>display: none;</xsl:text></xsl:attribute>
						</xsl:if>
						<label>
							<xsl:text>URI закладки</xsl:text>
							<br />
							<input id='editform-item-uri' name='item_uri' type='url' placeholder='https://example.com' value='' />
						</label>
					</p>
					<p id='editform-item-par-text' class='editform-edit'>
						<label>
							<xsl:value-of select='$varFormTextTagTitle' />
							<br />
							<xsl:choose>
								<xsl:when test='$varContentName="notes"'>
									<textarea id='editform-item-text' name='item_text' rows='12' placeholder='Текст'></textarea>
								</xsl:when>
								<xsl:otherwise>
									<input id='editform-item-text' name='item_text' type='text' placeholder='Текст' value='' />
								</xsl:otherwise>
							</xsl:choose>
						</label>
					</p>
					<!-- Элементы для перемещения -->
					<fieldset id='relocation-type' class='editform-relocate'>
						<legend>Тип перемещения</legend>
						<p class='checkbox-radio-par'>
							<label>
								<input id='editform-infolder-radio' name='relocation_type' type='radio' autofocus='autofocus' checked='checked' value='in_folder' />
								<xsl:text> в пределах папки</xsl:text>
							</label>
						</p>
						<p class='checkbox-radio-par'>
							<label>
								<input id='editform-outfolder-radio' name='relocation_type' type='radio' value='out_folder' />
								<xsl:text> в другую папку</xsl:text>
							</label>
						</p>
						<fieldset id='relocation-tree'>
							<legend>Папка для перемещения</legend>
							<ul class='root-relocation-tree-ul'>
								<li class='root-relocation-tree-li checkbox-radio-par'><!-- Элемент является модифицированной копией Раздела 07. для корневой папки -->
									<label>
										<input type='radio' name='relocation_destination_folder' checked='checked' value='0' />
										<xsl:text> </xsl:text>
										<span class='relocation-tree-li-label'>
											<xsl:value-of select='$varContentTitle' />
										</span>
									</label>
								</li>
								<xsl:if test='count(folder) > 0'>
									<ul class='relocation-tree-ul'>
										<xsl:apply-templates select='folder' mode='relocation-tree' /><!-- Раздел 06. -->
									</ul>
								</xsl:if>
							</ul>
						</fieldset>
					</fieldset>
					<fieldset id='relocation-order-number' class='editform-relocate-add'>
						<legend>Точка перемещения</legend>
						<p class='checkbox-radio-par'>
							<label>
								<input id='editform-firstordernumber-radio' name='relocation_order_number' type='radio' autofocus='autofocus' checked='checked' value='first' />
								<xsl:text> в начало папки</xsl:text>
							</label>
						</p>
						<p class='checkbox-radio-par'>
							<label>
								<input id='editform-lastordernumber-radio' name='relocation_order_number' type='radio' value='last' />
								<xsl:text> в конец папки</xsl:text>
							</label>
						</p>
						<p class='checkbox-radio-par'>
							<label>
								<input id='editform-setordernumber-radio' name='relocation_order_number' type='radio' value='set_order_number' />
								<xsl:text> задать порядковый номер </xsl:text>
							</label>
							<label>
								<span style='display:none;'><xsl:text>порядковый номер</xsl:text></span>
								<input id='relocation-order-setnumber' name='relocation_order_setnumber' type='number' size='3' value='1' min='1' max='1' step='1' />
							</label>
						</p>
						<p class='maxordernumber-input'><!-- class='editform-relocate-meta' -->
							<label>
								<xsl:text>(максимальный порядковый номер </xsl:text>
								<input id='editform-maxordernumber' name='relocation_maxordernumber' type='text' size='3' readonly='readonly' value='' />
								<xsl:text> )</xsl:text>
							</label>
						</p>
						<p class='editform-relocate-meta'>
							<label>
								<xsl:text>Наличие папок в папке назначения: </xsl:text>
								<input id='editform-has-folders' name='has_folders' type='text' size='5' readonly='readonly' value='' />
							</label>
						</p>
						<p class='editform-relocate-meta'>
							<label>
								<xsl:text>Наличие статей в папке назначения: </xsl:text>
								<input id='editform-has-items' name='has_items' type='text' size='5' readonly='readonly' value='' />
							</label>
						</p>
					</fieldset>
					<p class='editform-meta'>
						<label>
							<xsl:text>Id (назначения) родителя </xsl:text>
							<input id='editform-parentfolder-idtotal' name='parentfolder_idtotal' type='text' size='5' readonly='readonly' value='' />
						</label>
					</p>
					<p class='editform-meta'>
						<label>
							<xsl:text>Папка (результирующая) к отображению: </xsl:text>
							<input id='editform-folder-tooppen' name='folder_tooppen' type='text' size='5' readonly='readonly' value='' />
						</label>
					</p>
					<!-- Кнопки -->
					<p class='submit-buttons'>
						<button type='submit' id='submit'>OK</button>
						<button type='button' id='cancel'>Отмена</button>
					</p>
				</form>
			</dialog>
		</xsl:if>
	</main>
	<!-- ПОДВАЛ ОКНА -->
	<footer>
		<address>PersonalOrg.ru 2019, <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a></address>
	</footer>
</xsl:template>

</xsl:stylesheet>
