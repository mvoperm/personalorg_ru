<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 05. Отображаемая папка --><!-- Кроме корневой. Отображение корневой папки описано в разделе 03. -->
<xsl:template match='folder' mode='items'>
	<section class='itemsfolder'>
		<xsl:attribute name='data-folder-idtotal'>
			<xsl:number level='multiple' format='1-1' />
		</xsl:attribute>
		<!-- Шапка блока items -->
		<header>
			<!-- Коллонтитул блока items -->
			<div>
				<!-- Кнопка отображения/скрытия дерева папок -->
				<button class='toggle-folderstree-button'>&#9776;</button>
				<!-- Ветка родителей -->
				<xsl:if test='not($varContentName="options")'>
					<nav class='itemsfolder-branch-nav'>
						<span class='itemsfolder-branch-ancestor' data-startfolder='0'>
							<xsl:value-of select='$varContentTitle' />
						</span>
						<xsl:text> &#8594;</xsl:text>
						<xsl:for-each select='ancestor::folder'>
							<xsl:text> </xsl:text>
							<span class='itemsfolder-branch-ancestor'>
								<xsl:attribute name='data-startfolder'>
									<xsl:number level='multiple' format='1-1' />
								</xsl:attribute>
								<xsl:value-of select='title' />
							</span>
							<xsl:text> &#8594;</xsl:text>
						</xsl:for-each>
					</nav>
				</xsl:if>
			</div>
			<!-- Заголовок блока items -->
			<div class='items-header'>
				<!-- Заголовок -->
				<h2 class='items-h2'>
					<xsl:value-of select='title' />
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
							<p class='command-button'><button class='editmenu-button' data-edit-type='edit' data-element-toedit-type='folder'>Переименовать папку</button></p>
							<p class='command-button'><button class='editmenu-button' data-edit-type='relocate' data-element-toedit-type='folder'>Переместить папку</button></p>
							<p class='command-button'><button class='editmenu-button' data-edit-type='delete' data-element-toedit-type='folder'>Удалить папку</button></p>
						</menu>
					</details>
				</xsl:if>
			</div>
		</header>
		<!-- Содержание блока items -->
		<xsl:apply-templates select='item' /><!-- Раздел 7. -->
	</section>
</xsl:template>

</xsl:stylesheet>