<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 08. Содержание Пункта (для страницы настроек): форма внутри Пункта -->
<xsl:template match='form'>
	<form class='options-form'>
		<xsl:if test='count(id)>0'><xsl:attribute name='id'>
			<xsl:value-of select='id' />
		</xsl:attribute></xsl:if>
		<xsl:attribute name='action'>
			<xsl:if test='action="CHANGE_USER_EMAIL_FILEPATH"'>
				<xsl:value-of select='$varChangeUserEmailFilepath' />
			</xsl:if>
			<xsl:if test='action="CONFIRM_NEW_USER_EMAIL_FILEPATH"'>
				<xsl:value-of select='$varConfirmNewUserEmailFilepath' />
			</xsl:if>
			<xsl:if test='action="CHANGE_USER_PASSWORD_FILEPATH"'>
				<xsl:value-of select='$varChangeUserPasswordFilepath' />
			</xsl:if>
			<xsl:if test='action="DELETE_ACCOUNT_FILEPATH"'>
				<xsl:value-of select='$varDeleteAccountFilepath' />
			</xsl:if>
			<xsl:if test='action="CONFIRM_ACCOUNT_DELETION_FILEPATH"'>
				<xsl:value-of select='$varConfirmAccountDeletionFilepath' />
			</xsl:if>
			<xsl:if test='action="CHANGE_ARTICLE_COLOR_FILEPATH"'>
				<xsl:value-of select='$varChangeArticleColorFilepath' />
			</xsl:if>
			<xsl:if test='action="CHANGE_BASIC_FONT_FILEPATH"'>
				<xsl:value-of select='$varChangeBasicFontFilepath' />
			</xsl:if>
			<xsl:if test='action="CHANGE_BACKGROUND_IMAGE_FILEPATH"'>
				<xsl:value-of select='$varChangeBgImageFilepath' />
			</xsl:if>
		</xsl:attribute>
		<xsl:attribute name='method'>
			<xsl:text>POST</xsl:text>
		</xsl:attribute>
		<xsl:apply-templates /><!-- Раздел 09. -->
	</form>
</xsl:template>

</xsl:stylesheet>