<?php

// Загрузка документа и таблицы стилей в переменные
$content_filepath = get_xml_content(USER_FOLDER, $content);
if ($content_filepath === '')	{die ('Не удалось загрузить файл с информацией.');}
$xml = new DOMDocument();
$xml -> load($content_filepath);
$xsl = new DOMDocument();
$xsl -> load('content.xsl');
$xslt = new XSLTProcessor();
$xslt -> importStyleSheet($xsl);

// Установка параметров для таблицы стилей
$xslt -> setParameter('', 'domain_uri', DOMAIN_URI);
$xslt -> setParameter('', 'about_filepath', ABOUT_FILEPATH);
$xslt -> setParameter('', 'user_signout_filepath', USER_SIGNOUT_FILEPATH);
$xslt -> setParameter('', 'user_id', USER_ID);
$xslt -> setParameter('', 'user_email', USER_EMAIL);
$xslt -> setParameter('', 'user_folder', USER_FOLDER);
$xslt -> setParameter('', 'touch_screen', TOUCH_SCREEN);
$xslt -> setParameter('', 'startfolder', $startfolder);
$xslt -> setParameter('', 'contentname', $content);
$xslt -> setParameter('', 'contentItemname', ${$content}[0]);
$xslt -> setParameter('', 'contentTitle', ${$content}[1]);
// Для страницы настроек не применяются
$xslt -> setParameter('', 'edit_content_filepath', EDIT_CONTENT_FILEPATH);
$xslt -> setParameter('', 'user_options_filepath', USER_OPTIONS_FILEPATH);
$xslt -> setParameter('', 'content_title_genitive', ${$content}[2]);
$xslt -> setParameter('', 'content_title_accusative', ${$content}[3]);
// Только для страницы настроек
$xslt -> setParameter('', 'change_user_email_filepath', CHANGE_USER_EMAIL_FILEPATH);
$xslt -> setParameter('', 'new_user_email', $_SESSION['new_user_email'] ?? ''); // Заплатка для устранения конфликта версий php 7.+ и 5.6. После окончания поддержки версии 5.6. необходимо заменить на строку с нуль-коалесцентным оператором: $xslt -> setParameter('', 'new_user_email', $_SESSION['new_user_email'] ?? '');
$xslt -> setParameter('', 'confirm_new_user_email_filepath', CONFIRM_NEW_USER_EMAIL_FILEPATH);
$xslt -> setParameter('', 'change_user_password_filepath', CHANGE_USER_PASSWORD_FILEPATH);
$xslt -> setParameter('', 'delete_account_filepath', DELETE_ACCOUNT_FILEPATH);
$xslt -> setParameter('', 'confirm_account_deletion_filepath', CONFIRM_ACCOUNT_DELETION_FILEPATH);
$xslt -> setParameter('', 'change_article_color_filepath', CHANGE_ARTICLE_COLOR_FILEPATH);
$xslt -> setParameter('', 'change_basic_font_filepath', CHANGE_BASIC_FONT_FILEPATH);
$xslt -> setParameter('', 'basic_hue_text', BASIC_HUE_TEXT);
$xslt -> setParameter('', 'article_transparency_text', ARTICLE_TRANSPARENCY_TEXT);
$xslt -> setParameter('', 'basic_font_type', BASIC_FONT_TYPE);
$xslt -> setParameter('', 'basic_font_size', BASIC_FONT_SIZE);
$xslt -> setParameter('', 'change_bg_image_filepath', CHANGE_BACKGROUND_IMAGE_FILEPATH);
$xslt -> setParameter('', 'images_dirpath', IMAGES_DIRPATH);
// Режим тестирования
$xslt -> setParameter('', 'toggle_test_mode_filepath', TOGGLE_TEST_MODE_FILEPATH);
$xslt -> setParameter('', 'test_mode', TEST_MODE);
$xslt -> setParameter('', 'test_screen_filepath', TEST_SCREEN_FILEPATH);

// Трансформация документа для вывода в браузер
echo $xslt -> transformToXML($xml);

exit();

?>
