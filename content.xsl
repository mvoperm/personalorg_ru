<?xml version='1.0' encoding='utf-8' ?>

<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

<!-- 01. Объявление переменных -->
<xsl:include href='xsl/01_variables.xsl' />

<!-- 02. Создание структуры файла html -->
<xsl:include href='xsl/02_html_structure.xsl' />

<!-- 03. Разметка основных отображаемых блоков -->
<xsl:include href='xsl/03_mainblocks.xsl' />

<!-- 04. Дерево папок -->
<xsl:include href='xsl/04_folderstree.xsl' />

<!-- 05. Отображаемая папка -->
<xsl:include href='xsl/05_items.xsl' />

<!-- 06. Дерево папок для перемещения -->
<xsl:include href='xsl/06_relocation_tree.xsl' />

<!-- 07. Единичный элемент (пункт) -->
<xsl:include href='xsl/07_item.xsl' />

<!-- 08. Содержание Пункта (для страницы настроек): форма внутри Пункта -->
<xsl:include href='xsl/08_options_form.xsl' />

<!-- 09. Содержание Пункта: ссылка и параграф/комментарий -->
<xsl:include href='xsl/09_item_content.xsl' />

<!-- 10. Содержание параграфа в формах страницы настроек -->
<xsl:include href='xsl/10_options_par.xsl' />

</xsl:stylesheet>
