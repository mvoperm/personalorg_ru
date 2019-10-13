<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 04. Дерево папок -->
<xsl:template match='folder' mode='tree'>
	<details>
		<xsl:attribute name='class'>
			<xsl:if test='count(folder) > 0'>
				<xsl:text>subfolders </xsl:text>
			</xsl:if>
			<xsl:text>folderstree-details</xsl:text>
		</xsl:attribute>
		<summary class='folderstree-summary'>
			<xsl:attribute name='data-folder-idtotal'>
				<xsl:number level='multiple' format='1-1' count='folder' />
			</xsl:attribute>
			<xsl:value-of select='title' />
		</summary>
		<xsl:apply-templates select='folder' mode='tree' /><!-- Раздел 04. - РЕКУРСИЯ -->
	</details>
	
</xsl:template>

</xsl:stylesheet>