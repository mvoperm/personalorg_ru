<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 01. Объявление переменных (шаблон для включения) -->
<xsl:variable name='varDomainUri' select='$domain_uri' />
<xsl:variable name='varAboutFilepath' select='$about_filepath' />
<xsl:variable name='varUserSignoutFilepath' select='$user_signout_filepath' />
<xsl:variable name='varUserId' select='$user_id' />
<xsl:variable name='varUserEmail' select='$user_email' />
<xsl:variable name='varUserFolder' select='$user_folder' />
<xsl:variable name='varTouchScreen' select='$touch_screen' />
<xsl:variable name='varStartFolder' select='$startfolder' /><!-- Для настроек равно 2 -->
<xsl:variable name='varContentName' select='$contentname' />
<xsl:variable name='varContentItemName' select='$contentItemname' />
<xsl:variable name='varContentTitle' select='$contentTitle' />
<!-- Для страницы настроек не применяются -->
<xsl:variable name='varEditContentFilepath' select='$edit_content_filepath' />
<xsl:variable name='varUserOptionsFilepath' select='$user_options_filepath' />
<xsl:variable name='varContentTitleGenitive' select='$content_title_genitive' />
<xsl:variable name='varContentTitleAccusative' select='$content_title_accusative' />
<xsl:variable name='varFormTextTagTitle'>
	<xsl:choose>
		<xsl:when test='$varContentName="notes"'><xsl:text>Текст</xsl:text></xsl:when>
		<xsl:otherwise><xsl:text>Комментарий</xsl:text></xsl:otherwise>
	</xsl:choose>
</xsl:variable>
<!-- Только для страницы настроек -->
<xsl:variable name='varChangeUserEmailFilepath' select='$change_user_email_filepath' />
<xsl:variable name='varNewUserEmail' select='$new_user_email' />
<xsl:variable name='varConfirmNewUserEmailFilepath' select='$confirm_new_user_email_filepath' />
<xsl:variable name='varChangeUserPasswordFilepath' select='$change_user_password_filepath' />
<xsl:variable name='varDeleteAccountFilepath' select='$delete_account_filepath' />
<xsl:variable name='varConfirmAccountDeletionFilepath' select='$confirm_account_deletion_filepath' />
<xsl:variable name='varChangeArticleColorFilepath' select='$change_article_color_filepath' />
<xsl:variable name='varBasicHueText' select='$basic_hue_text' />
<xsl:variable name='varArticleTransparencyText' select='$article_transparency_text' />
<xsl:variable name='varChangeBasicFontFilepath' select='$change_basic_font_filepath' />
<xsl:variable name='varBasicFontType' select='$basic_font_type' />
<xsl:variable name='varBasicFontSize' select='$basic_font_size' />
<xsl:variable name='varChangeBgImageFilepath' select='$change_bg_image_filepath' />
<xsl:variable name='varImagesDirpath' select='$images_dirpath' />
<!-- Режим тестирования -->
<xsl:variable name='varTestMode' select='$test_mode' />
<xsl:variable name='varToggleTestModeFilepath' select='$toggle_test_mode_filepath' />
<xsl:variable name='varTestScreenFilepath' select='$test_screen_filepath' />

</xsl:stylesheet>