<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 02. Создание структуры файла html -->
<xsl:template match='/'>
	<html>
		<head>
			<meta charset='utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0' />
			<title><!-- Заголовок страницы в браузере -->
				<xsl:text>PersonalOrg.ru - </xsl:text>
				<xsl:value-of select='$varContentTitle' />
			</title>
			<!-- Переменные css -->
			<style id='css-variables'><!-- лист стилей переменных -->
				<xsl:attribute name='data-user-id'>
					<xsl:value-of select='$varUserId' />
				</xsl:attribute>
				<xsl:attribute name='data-user-folder'>
					<xsl:value-of select='$varUserFolder' />
				</xsl:attribute>
			</style>
			<script type='module' src='js/css_variables.js'></script><!-- скрипт назначения переменных css -->
			<!-- Основной каскад стилей -->
			<link rel='stylesheet'>
				<xsl:attribute name='href'>
					<xsl:value-of select='$varDomainUri' />
					<xsl:text>/css/main.css</xsl:text>
				</xsl:attribute>
			</link>
			<!-- Стили для режима тестирования -->
			<xsl:if test='$varTestMode=1'>
				<link rel='stylesheet'>
					<xsl:attribute name='href'>
						<xsl:value-of select='$varDomainUri' />
						<xsl:text>/css/test-main.css</xsl:text>
					</xsl:attribute>
				</link>
			</xsl:if>
			<!-- Стили, различающиеся для сенсорных и несенсорных устройств -->
			<link rel='stylesheet'>
				<xsl:attribute name='href'>
					<xsl:value-of select='$varDomainUri' />
					<xsl:text>/css/</xsl:text>
					<xsl:value-of select='$varTouchScreen' />
					<xsl:text>.css</xsl:text>
				</xsl:attribute>
			</link>
			<!-- Стили, задаваемые с помощью Js -->
			<style id='currentfolder-items'></style><!-- Стиль для отображения выбранной папки и скрытие остальных -->
			<style id='editform-type'></style><!-- Стиль для отображения формы соответствующего типа -->
			<style id='toggle-folderstree'></style><!-- Стиль для отображения/скрытия дерева папок -->
			<script type='module' src='js/main.js'></script><!-- Основной скрипт -->
			<!-- Специальные стили страницы настроек -->
			<xsl:if test='$varContentName="options"'>
				<link rel='stylesheet' href='/css/options.css' />
				<script type='module' src='js/user_options.js'></script>
			</xsl:if>
		</head>
		<body>
			<xsl:attribute name='data-startfolder'>
				<xsl:value-of select='$varStartFolder' />
			</xsl:attribute>
			<xsl:apply-templates /><!-- Раздел 03. -->
		</body>
	</html>
</xsl:template>

</xsl:stylesheet>