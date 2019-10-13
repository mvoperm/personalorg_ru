<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 09. Содержание Пункта: ссылка и параграф/комментарий -->
<xsl:template match='source'>
	<p class='uri'><a>
		<xsl:attribute name='href'>
			<xsl:value-of select='.' />
		</xsl:attribute>
		<xsl:attribute name='target'>
			<xsl:text>_blank</xsl:text>
		</xsl:attribute>
		<xsl:value-of select='.' />
	</a></p>
</xsl:template>
<xsl:template match='par'>
	<p>
		<xsl:attribute name='class'>
			<xsl:choose>
				<xsl:when test='$varContentName="options"'><xsl:text>options-par</xsl:text></xsl:when>
				<xsl:otherwise><xsl:text>multipar-text</xsl:text></xsl:otherwise>
			</xsl:choose>
		</xsl:attribute>
		<xsl:apply-templates />
	</p>
</xsl:template>
<xsl:template match='annotation'>
	<p class='annotation'>
		<xsl:apply-templates />
	</p>
</xsl:template>

</xsl:stylesheet>