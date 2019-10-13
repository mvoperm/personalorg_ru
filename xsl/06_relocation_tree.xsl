<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 06. Дерево папок для перемещения -->
<xsl:template match='folder' mode='relocation-tree'>
	<li class='relocation-tree-li checkbox-radio-par'>
		<label>
			<input type='radio' name='relocation_destination_folder'>
				<xsl:attribute name='value'>
					<xsl:number level='multiple' format='1-1' />
				</xsl:attribute>
			</input>
			<xsl:text> </xsl:text>
			<span class='relocation-tree-li-label'>
				<xsl:value-of select='title' />
			</span>
		</label>
	</li>
	<xsl:if test='count(folder) > 0'>
		<ul class='relocation-tree-ul'>
			<xsl:apply-templates select='folder' mode='relocation-tree' /><!-- Раздел 06. - РЕКУРСИЯ -->
		</ul>
	</xsl:if>
</xsl:template>

</xsl:stylesheet>