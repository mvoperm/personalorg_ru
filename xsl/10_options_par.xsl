<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 10. Содержание параграфа в формах страницы настроек -->
<xsl:template match='action | id' />
<xsl:template match='label'>
	<label>
		<xsl:apply-templates />
	</label>
</xsl:template>
<xsl:template match='select'>
	<select>
		<xsl:if test='count(id)>0'><xsl:attribute name='id'>
			<xsl:value-of select='id' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(name)>0'><xsl:attribute name='name'>
			<xsl:value-of select='name' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(required)>0'><xsl:attribute name='required'>
			<xsl:value-of select='required' />
		</xsl:attribute></xsl:if>
		<xsl:attribute name='size'><xsl:choose>
			<xsl:when test='count(size)>0'>
				<xsl:value-of select='size' />
			</xsl:when>
			<xsl:otherwise>
				<xsl:text>1</xsl:text>
			</xsl:otherwise>
		</xsl:choose></xsl:attribute>
		<xsl:if test='count(hint)>0'><xsl:attribute name='title'>
			<xsl:value-of select='hint' />
		</xsl:attribute></xsl:if>
		<xsl:apply-templates select='options' />
	</select>
</xsl:template>
<xsl:template match='options'>
		<xsl:apply-templates select='option' />
</xsl:template>
<xsl:template match='option'>
	<option>
		<xsl:if test='ancestor::select[value="BASIC_FONT_TYPE"]'>
			<xsl:if test='child::text()=$varBasicFontType'><!--  -->
				<xsl:attribute name='selected'>
					<xsl:value-of select='selected' />
				</xsl:attribute>
			</xsl:if>
		</xsl:if>
		<xsl:attribute name='value'>
			<xsl:value-of select='.' />
		</xsl:attribute>
		<xsl:value-of select='.' />
	</option>
</xsl:template>
<xsl:template match='input'>
	<input>
		<xsl:attribute name='type'>
			<xsl:value-of select='type' />
		</xsl:attribute>
		<xsl:if test='count(id)>0'><xsl:attribute name='id'>
			<xsl:value-of select='id' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(name)>0'><xsl:attribute name='name'>
			<xsl:value-of select='name' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(required)>0'><xsl:attribute name='required'>
			<xsl:value-of select='required' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(checked)>0'><xsl:attribute name='checked'>
			<xsl:value-of select='checked' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(size)>0'><xsl:attribute name='size'>
			<xsl:value-of select='size' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(minlength)>0'><xsl:attribute name='minlength'>
			<xsl:value-of select='minlength' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(maxlength)>0'><xsl:attribute name='maxlength'>
			<xsl:value-of select='maxlength' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(min)>0'><xsl:attribute name='min'>
			<xsl:value-of select='min' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(max)>0'><xsl:attribute name='max'>
			<xsl:value-of select='max' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(step)>0'><xsl:attribute name='step'>
			<xsl:value-of select='step' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(hint)>0'><xsl:attribute name='title'>
			<xsl:value-of select='hint' />
		</xsl:attribute></xsl:if>
		<xsl:if test='count(value)>0'><xsl:attribute name='value'>
			<xsl:choose>
				<xsl:when test='value="$_SESSION[new_user_email]"'><xsl:value-of select='$varNewUserEmail' /></xsl:when>
				<xsl:when test='value="BASIC_HUE_TEXT"'><xsl:value-of select='$varBasicHueText' /></xsl:when>
				<xsl:when test='value="ARTICLE_TRANSPARENCY_TEXT"'><xsl:value-of select='$varArticleTransparencyText' /></xsl:when>
				<xsl:when test='value="BASIC_FONT_SIZE"'><xsl:value-of select='$varBasicFontSize' /></xsl:when>
				<xsl:otherwise><xsl:value-of select='value' /></xsl:otherwise>
			</xsl:choose>
		</xsl:attribute></xsl:if>
	</input>
</xsl:template>
<xsl:template match='button'>
	<button class='options-button'>
		<xsl:attribute name='type'>
			<xsl:value-of select='type' />
		</xsl:attribute>
		<xsl:if test='count(id)>0'><xsl:attribute name='id'>
			<xsl:value-of select='id' />
		</xsl:attribute></xsl:if>
		<xsl:apply-templates select='text' />
	</button>
</xsl:template>
<xsl:template match='text'>
	<xsl:value-of select='.' />
</xsl:template>
<xsl:template match='images'>
	<div id='bg-images-collection'>
		<xsl:apply-templates select='image' />
	</div>
</xsl:template>
<xsl:template match='image'>
	<figure>
		<xsl:attribute name='title'>
			<xsl:value-of select='.' />
		</xsl:attribute>
		<img>
			<xsl:attribute name='alt'>
				<xsl:value-of select='.' />
			</xsl:attribute>
			<xsl:attribute name='src'>
				<xsl:value-of select='$varImagesDirpath' />
				<xsl:text>/</xsl:text>
				<xsl:value-of select='.' />
			</xsl:attribute>
		</img>
		<figcaption class='bg-image-figcaption'>
			<xsl:value-of select='.' />
		</figcaption>
	</figure>
</xsl:template>
<xsl:template match='br'>
	<br />
</xsl:template>

</xsl:stylesheet>