<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

// Код блока проверки возможностей браузера (аналогичный код встроен в страницу about.php)
$browser_check_code = <<<EOT
	<style id='js5-css'></style>
	<script src='js/js5_check.js' nomodule defer></script>
	<style id='noscript-disable'></style>
EOT;

?>

<!-- СТРАНИЦА ФОРМЫ ДЛЯ АВТОРИЗАЦИИ ПОЛЬЗОВАТЕЛЯ НА САЙТЕ -->
<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>PersonalOrg.ru - авторизация</title>
	<?= $browser_check_code; // Код блока проверки возможностей браузера ?>
	<link rel='stylesheet' href='/css/browserreset.css'>
	<link rel='stylesheet' href='/css/entry-form.css'>
	<link rel='stylesheet' href='/css/page-title.css'>
	<link rel='stylesheet' href='/css/item.css'>
	<link rel='stylesheet' href='/css/index.css'>
	<script type='module' src='js/index.js'></script>
	<link rel='stylesheet' href='/css/no-js.css'><!-- Стиль для страницы без JavaScript -->
</head>
<body>
	<h1 class='page-title'>Персональный онлайн-органайзер</h1>
	<p class='about'><a href='<?= DOMAIN_URI . ABOUT_FILEPATH; ?>' target='_blank'>О сервисе [&#8663;]</a></p>

	<noscript><p class='alert'>Для работы данной программы необходима поддержка языка программирования JavaScript.<br>Если Вы хотели бы использовать данный ресурс, пожалуйста, включите поддержку JavaScript в Вашем браузере.</p></noscript>

	<div class='js5 alert'>
		<p class='warning'>Для работы сервиса необходима поддержка браузером языка программирования JavaScript с поддержкой модулей (ECMAScript 2017 или ES8).</p>
		<p>Ваш браузер использует устаревшую версию этого языка!</p>
		<p>Сведения о поддержке браузерами используемой версии языка JavaScript можно найти на ресурсе <a href='https://caniuse.com/#search=HTML%20element%20script%20type%20module' target='_blank'>Can I use ... [&#8663;]</a></p>
	</div>

	<dialog id='dialog-element'></dialog>
	<p id='dialog-alert-index' class='js-only alert'>К сожалению, Ваш браузер не поддерживает элемент, используемый в данной программе. <a href='<?php echo DOMAIN_URI . ABOUT_FILEPATH; ?>' target='_blank'>Подробности [&#8663;]</a><br />Без этого элемента можно просматривать существующие записи, но нельзя осуществлять никакое редактирование.<br>* В браузере Firefox для настольного компьютера эту поддержку можно включить.</p>

	<form id='authorization-form' class='inpage-form js-only' action='<?php echo AUTH_FORM_HANDLING_FILEPATH; ?>' method='POST'>
		<h3 class='form-header'>Авторизация</h3>
		<fieldset id='authorization-type'>
			<legend>Вид авторизации</legend>
			<p class='checkbox-p'><label><input type='radio' name='authorization_action' checked value='user_login'><span class='check-span'> Вход в систему</span></label></p>
			<p class='checkbox-p'><label><input class='dialog-only' type='radio' name='authorization_action' value='user_signin'><span class='check-span'> Регистрация</span></label></p>
			<p class='checkbox-p'><label><input type='radio' name='authorization_action' value='password_recovery'><span class='check-span'> Восстановление пароля</span></label></p>
		</fieldset>
		<fieldset>
			<p class='text-input-p'><label>
				<span id='login-title'>ID или адрес электронной почты:</span>
				<input type='text' id='login' name='login' required size='20' value=''>
			</label></p>
			<p id='login-comment' class='text-input-p'>(Вы сможете сменить адрес электронной почты в любой момент)</p>
			<p id='password-recovery-comment' class='text-input-p'>На Ваш адрес электронной почты будет направлено письмо со сгенерированным паролем для Вашего аккаунта.</p>
			<p id='password-label' class='text-input-p'><label><span id='password-title'>Пароль:</span>
				<input type='password' id='password' name='password' required size='20' minlength=6 maxlength=30 title='Пароль должен содержать от 6 до 30 символов'>
				<button type='button' id='toggle-password-type' class='auxiliary-button'>Показать пароль</button>
			</label></p>
		</fieldset>
		<p id='touchscreen-check'><label>Поддержка сенсорных событий экрана: <input type='text' id='touchscreen-value' name='touchscreen_value' readonly='readonly' value=''></label></p>
		<!--p id='remember-me-label'><label><input type='checkbox' id='remember-me' name='remember_me' /> Запомнить меня на этом устройстве<br /><br /></label></p--><!-- к дальнейшей проработке -->
		<p class='submit-buttons-p'><button type='submit' id='submit'>Войти</button></p>
	</form>
	<div id='news'>
	<h4>Новости</h4>
	<article class='item'>
		<h5 class='item-h5-index'>27.10.2019. Изменения в программном коде системы</h5>
		<p class='multipar-text'>Произведены существенные изменения в программном коде системы, связанные с переходом на более новую версию серверного языка и отказом от ряда неэффективных технологий.</p>
		<p class='multipar-text'>Для пользователя системы практически никаких изменений не произошло.</p>
	</article>
	<article class='item'>
		<h5 class='item-h5-index'>08.09.2019. Доработка мобильной версии и другие улучшения</h5>
		<p class='multipar-text'>Доработаны стили представления информации, в основном касающиеся удобства работы на небольших сенсорных экранах мобильных устройств. Сейчас сервисом можно вполне комфортно пользоваться на устройстве с шириной экрана в портретной ориентации 360px.</p>
		<p class='multipar-text'>За три месяца с момента запуска органайзера проведено тестирование функционала и исправлены замеченные ошибки.</p>
	</article>
	<article class='item'>
		<h5 class='item-h5-index'>19.05.2019. Запуск онлайн-органайзера PersonalOrg.ru</h5>
		<p class='multipar-text'>Сервис запущен в режиме &#946;-тестирования. На данном этапе действуют блоки закладок и заметок.</p>
		<p class='multipar-text'>Ссылка на информацию о сервисе находится в верхней правой части страницы.</p>
	</article>
	</div>
</body>
</html>
