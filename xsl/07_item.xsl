<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 07. Единичный элемент (пункт) -->
<xsl:template match='item'>
	<article>
		<xsl:attribute name='data-folder-idtotal'>
			<xsl:choose>
				<xsl:when test='count(ancestor::folder) = 0'>
					<xsl:text>0</xsl:text>
				</xsl:when>
				<xsl:otherwise>
					<xsl:number level='multiple' format='1-1' count='folder' />
				</xsl:otherwise>
			</xsl:choose>
		</xsl:attribute>
		<xsl:attribute name='data-idlocal'>
			<xsl:number format='1' />
		</xsl:attribute>
		<xsl:attribute name='class'>
			<xsl:text>item </xsl:text>
			<xsl:value-of select='$varContentItemName' />
		</xsl:attribute>
		<div class='item-header'>
			<!-- Заголовок -->
			<h4>
				<xsl:attribute name='class'>
					<xsl:choose>
						<xsl:when test='$varContentName="bookmarks"'><xsl:text>item-h4-bookmarks</xsl:text></xsl:when>
						<xsl:otherwise><xsl:text>item-h4-notes</xsl:text></xsl:otherwise>
					</xsl:choose>
				</xsl:attribute>
				<xsl:value-of select='title' />
			</h4>
			<!-- Меню для редактирования -->
			<xsl:if test='not($varContentName="options")'>
				<details class='editmenu'>
					<summary title='Меню' class='editmenu-summary'>
						<xsl:text>&#65049;</xsl:text>
					</summary>
					<menu class='editmenu-subdetails'>
						<p class='command-button'><button class='editmenu-button' data-edit-type='edit' data-element-toedit-type='item'>
							<xsl:text>Редактировать </xsl:text>
							<xsl:value-of select='$varContentTitleAccusative' />
						</button></p>
						<p class='command-button'><button class='editmenu-button' data-edit-type='relocate' data-element-toedit-type='item'>
							<xsl:text>Переместить </xsl:text>
							<xsl:value-of select='$varContentTitleAccusative' />
						</button></p>
						<p class='command-button'><button class='editmenu-button' data-edit-type='delete' data-element-toedit-type='item'>
							<xsl:text>Удалить </xsl:text>
							<xsl:value-of select='$varContentTitleAccusative' />
						</button></p>
					</menu>
				</details>
			</xsl:if>
		</div>
		<!-- Содержание -->
		<xsl:apply-templates select='images' /><!-- Раздел 10. -->
		<xsl:apply-templates select='form' /><!-- Раздел 08. -->
		<xsl:apply-templates select='par' /><!-- Раздел 09. -->
		<xsl:apply-templates select='source' /><!-- Раздел 09. -->
		<xsl:apply-templates select='annotation' /><!-- Раздел 09. -->
	</article>
</xsl:template>

</xsl:stylesheet>