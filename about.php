<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

// Код блока проверки возможностей браузера (аналогичный код встроен в страницу index.php)
$browser_check_code = <<<EOT
	<script type='module'>document.getElementById('js6-check').innerHTML = '1';</script>
	<style id='js5-css'></style>
	<script src='js/js5_check.js' defer></script>
	<style id='noscript-disable'></style>
	<script type='module' src='js/js6_dialog_check.js'></script>
EOT;

?>

<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>PersonalOrg.ru - информация о сервисе</title>
	<?= $browser_check_code; // Код блока проверки возможностей браузера ?>
	<link rel='stylesheet' href='/css/main.css'>
	<link rel='stylesheet' href='/css/about.css'>
	<link rel='stylesheet' href='/css/sensor.css'>
	<style id='currentfolder-items'></style><!-- Стиль для отображения выбранной папки и скрытия остальных -->
	<script type='module' src='js/main.js'></script>
	<link id='no-js-css' rel='stylesheet' href='/css/no-js.css'>
</head>
<body data-startfolder='1'>
	<header class='body-header'>
		<h1 class='page-title'>Персональный онлайн-органайзер</h1>
		<div id='headermenu' class='flex-line-basic flex-line-wrap-reverse'>
			<nav class='flex-line-grow-el'>
				<ul class='header-contents-list-ul'>
					<li class='header-contents-list-li'>Информация о сервисе</li>
				</ul>
			</nav>
			<p class='header-menu'><a href='/' target='_blank'>На страницу авторизации [&#8663;]</a></p>
		</div>
	</header>
	<main>
		<section id='folderstree'>
			<nav>
				<details open class='subfolders root-folderstree-details'>
					<summary class='folderstree-summary' data-folder-idtotal='0'>Разделы</summary>
					<details class='folderstree-details'>
						<summary class='folderstree-summary' data-folder-idtotal='1'>Техническая информация</summary>
					</details>
					<details class='folderstree-details'>
						<summary class='folderstree-summary' data-folder-idtotal='2'>Описание функционала сервиса</summary>
					</details>
					<details class='folderstree-details'>
						<summary class='folderstree-summary' data-folder-idtotal='3'>Авторизация</summary>
					</details>
					<details class='folderstree-details'>
						<summary class='folderstree-summary' data-folder-idtotal='4'>Контакты</summary>
					</details>
				</details>
			</nav>
		</section>
		<section id='items'>
			<section class='itemsfolder' data-folder-idtotal='0'>
				<header>
					<div class='items-header'>
						<h2 class='items-h2'>Разделы</h2>
					</div>
				</header>
			</section>
			<section class='itemsfolder' data-folder-idtotal='1'>
				<header>
					<div>
						<button class='toggle-folderstree-button js-only'>&#9776;</button>
					</div>
					<div class='items-header'>
						<h2 class='items-h2'>Техническая информация</h2>
					</div>
				</header>
				<article data-folder-idtotal='1' data-idlocal='1' class='item'>
					<h4 class='item-h4-notes'>Условия пользования сервисом.</h4>
					<p>Сервис является бесплатным.</p>
				</article>
				<article data-folder-idtotal='1' data-idlocal='2' class='item'>
					<h4 class='item-h4-notes'>Язык JavaScript.</h4>
					<p>Для работы сервиса необходимо включение языка программирования JavaScript с поддержкой версии 8 (ECMAScript 2017 или ES8).</p>
					<noscript><p class='warning'>В Вашем браузере этот язык отключен!</p>
					<p>Включается он, как правило, на страницах настроек браузера.</p>
					<p>Вся информация на данной странице будет доступна и без включения JavaScript, но его включение сделает чтение страницы более удобным.</p>
					</noscript>
					<div class='js5'>
						<p id = 'js6-check' style='display: none;'></p>
						<p class='warning'>Ваш браузер использует устаревшую версию этого языка!</p>
					    <p>Сведения о поддержке браузерами используемой версии языка JavaScript можно найти на ресурсе <a href='https://caniuse.com/#search=ECMAScript%202015%20(ES6)' target='_blank'>Can I use ... [&#8663;]</a></p>
					</div>
					<p class='js-only ok'>В Вашем браузере этот язык включен и поддерживает требуемую версию.</p>
				</article>
				<article data-folder-idtotal='1' data-idlocal='3' class='item'>
					<h4 class='item-h4-notes'>Элемент <code>dialog</code>.</h4>
					<p>Сервис в своей работе использует html-элемент <code>dialog</code>, который поддерживается не всеми браузерами.</p>
					<noscript><p class='warning'>В данном абзаце встроена проверка поддержки текущим браузером элемента <code>dialog</code>, но она у Вас не работает в связи с тем, что отключен JavaScript.</p></noscript>
					<div class='js5'>
						<p class='warning'>В данном абзаце встроена проверка поддержки текущим браузером элемента <code>dialog</code>, но она у Вас не работает в связи с тем, что Вы используете браузер, не поддерживающbq необходимую версию языка JavaScript.</p>
					</div>
					<dialog id='dialog-element'></dialog>
					<p class='js-only' id='dialog-alert-about'></p>
					<section class='internal'>
						<h6>Работа элемента <code>dialog</code> была протестирована на следующих браузерах:</h6>
						<ul>
							<li>Яндекс.Браузер (версия 19 для настольного компьютера и для операционной системы Android);</li>
							<li>Firefox (версии 66-70 для настольного компьютера);</li>
							<p class='annotation'>Примечание: для поддержки данного элемента в командной строке браузера Firefox необходимо набрать <code>about:congif</code> и в строке <code>dom.dialog_element.enabled</code> установить значение <code>true</code>.</p>
							<li>Chrome (версия 74-76 для настольного компьютера);</li>
							<li>Opera (версия 60-63 для настольного компьютера).</li>
						</ul>
					</section>
					<section class='internal'>
					<h6>В соответствии с информацией ресурса <a href='https://caniuse.com/#search=dialog%20element' target='_blank'>Can I use ... [&#8663;]</a> данный элемент</h6>
					<ul>
						<li>поддерживается следующими браузерами:</li>
						<ul>
							<li>Chrome (начиная с версии 37 для настольного компьютера, версия 74 для мобильных устройств с операционной системой Android);</li>
							<li>Opera (начиная с версии 24 для настольного компьютера, версия 46 для мобильных устройств с операционной системой Android);</li>
							<li>Firefox (начиная с версии 53 для настольного компьютера при значении <code>dom.dialog_element.enabled</code> равным <code>true</code>);</li>
							<li>Edge (версия 76);</li>
							<li>Samsung Internet;</li>
							<li>Android Browser (версия 67).</li>
						</ul>
						<li>не поддерживается следующими браузерами:</li>
						<ul>
							<li>Internet Explorer;</li>
							<li>Safari;</li>
							<li>Firefox для Android;</li>
							<li>Edge (до версии 18 включительно);</li>
							<li>Opera Mini;</li>
							<li>Android Browser (до версии 4.4.4 включительно).</li>
						</ul>
					</ul>
					<p class='annotation'>Полную информацию о поддержке данного элемента различными браузерами можно найти на вышеуказанном ресурсе.</p>
					</section>
					<p>Поддерживается или нет элемент <code>dialog</code> в Вашем браузере, написано во второй строке данной Статьи.</p>
					<p>Также, если <code>dialog</code> не поддерживается браузером, будет предупреждение на странице авторизации.</p>
				</article>
				<article data-folder-idtotal='1' data-idlocal='4' class='item'>
					<h4 class='item-h4-notes'>Конфиденциальность данных.</h4>
					<p>Разработчик сервиса пострался учесть все вопросы конфиденциальности хранимых Пользователем данных. Тем не менее, любую информацию, размещённую в интернете, можно при определённых обстоятельствах прочитать.</p>
					<p>В связи с этим, просим не пользоваться данным ресурсом для хранения информации, обладание которой третьими лицами способно нанести Вам чувствительный ущерб.</p>
				</article>
				<article data-folder-idtotal='1' data-idlocal='5' class='item'>
					<h4 class='item-h4-notes'>Чувствительность к потере данных.</h4>
					<p>В программе возможны ошибки, которые могут привести к различным последствиям, в т.ч. к потере пользовательских данных.</p>
					<p>В связи с этим рекомендуем иметь копию данных, потеря которых может принести ущерб.</p>
				</article>
				<article data-folder-idtotal='1' data-idlocal='6' class='item'>
					<h4 class='item-h4-notes'>Условия предоставления сервиса.</h4>
					<p>Данный сервис предоставляется "как есть".</p>
					<p>Разработчик ресурса постарается оперативно реагировать на возникающие проблемы и учесть все замечания и пожелания пользователей. Однако с учётом бесплатности сервиса и ограниченности ресурсов на его поддержание гарантировать удовлетворение каждого конкретного требования Пользователя нет возможности.</p>
				</article>
			</section>
			<section class='itemsfolder' data-folder-idtotal='2'>
				<header>
					<div>
						<button class='toggle-folderstree-button js-only'>&#9776;</button>
					</div>
					<div class='items-header'>
						<h2 class='items-h2'>Описание функционала сервиса</h2>
					</div>
				</header>
				<article data-folder-idtotal='2' data-idlocal='1' class='item'>
					<h4 class='item-h4-notes'>Назначение.</h4>
					<p>Сервис предназначен для хранения информации в блоках с однотипной структурой. На данном этапе реализованы блоки закладок и заметок.</p>
					<p>Информационная единица (статья) в каждом блоке имеет свой набор полей.</p>
					<p>Статья блока закладок содержит поля заголовка, адреса ссылки и комментария.</p>
					<p>Статья блока заметок содержит поле заголовка и текстовое поле для ввода неформатированного текста. В текстовом поле этого блока допускается деление на абзацы.</p>
				</article>
				<article data-folder-idtotal='2' data-idlocal='2' class='item'>
					<h4 class='item-h4-notes'>Структурирование.</h4>
					<p>Каждый блок имеет древовидную структуру аналогичную структуре хранения папок и файлов на компьютере ( <a href='/screenshots/full_screen.png' target='_blank'>скриншот [&#8663;]</a> ). Данная структура полностью создаётся Пользователем.</p>
					<p>Каждая папка может включать другие папки и статьи. Количество каждого элемента и сложность структуры не ограничена.</p>
					<p>В дереве папок справа осуществляется навигация по содержимому. Подпапки могут сворачиваться и разворачиваться. Значок <code>&#8631;</code> рядом в папкой означает, что она имеет свёрнутые подпапки.</p>
					<p>Дерево папок можно скрыть или отобразить с помощь специальной кнопки, расположенной в левом верхнем углу блока статей ( <a href='/screenshots/hamburger.png' target='_blank'>скриншот [&#8663;]</a> ). Данная кнопка содержит значок гамбургера [ &#9776; ] и в зависимости от параметров устройства, бразуера и открытой страницы может содержать поясняющую надпись. Для малой ширины окна браузера дерево при начальной загрузке страницы скрывается.</p>
				</article>
				<article data-folder-idtotal='2' data-idlocal='3' class='item'>
					<h4 class='item-h4-notes'>Операции с папками и статьями.</h4>
					<p>Операции с элементами пользовательской информации осуществляются через меню, которое имеется у каждой отображаемой папки и статьи ( <a href='/screenshots/editmenu.png' target='_blank'>скриншот [&#8663;]</a> ).</p>
					<section class='internal'>
						<h6>Предусмотрены следующие операции:</h6>
						<ul>
							<li>Добавление (создание) папки или статьи.</li>
							<li>Редактирование ( <a href='/screenshots/editform_edit_1.png' target='_blank'>скриншот 1 [&#8663;]</a> ,  <a href='/screenshots/editform_edit_2.png' target='_blank'>скриншот 2 [&#8663;]</a> ).</li>
							<p class='annotation'>В случае с Папкой термин "редактирование" означает её переименование.</p>
							<li>Перемещение ( <a href='/screenshots/editform_replace.png' target='_blank'>скриншот [&#8663;]</a> ).</li>
							<p class='annotation'>Перемещение может осуществляться как в пределах текущей папки, так и в любую другую. Исключением является невозможность перемещения папки в саму себя и в любой из своих потомков.</p>
							<li>Удаление.</li>
							<p class='annotation'>Папка удаляется вместе со всеми вложенными в неё папками и статьями.</p>
						</ul>
						<p>При перемещении и добавлении элемента есть возможность выбрать его порядковый номер в списке.</p>
					</section>
				</article>
				<article data-folder-idtotal='2' data-idlocal='4' class='item'>
					<h4 class='item-h4-notes'>Настройки пользователя.</h4>
					<p>Пользователь имеет возможность менять некоторые параметры как авторизационных данных (адрес электронной почты и пароль), так и параметры представления его информации (цвет, размер шрифта, фон и т.п.) Сделать это можно на странице настроек ( <a href='/screenshots/options_appearance.png' target='_blank'>скриншот 1 [&#8663;]</a> , <a href='/screenshots/options_background.png' target='_blank'>скриншот 2 [&#8663;]</a> ), перейти на которую можно через меню, раскрывающееся из идентификационных данных Пользователя в шапке страницы ( <a href='/screenshots/options_menu.png' target='_blank'>скриншот [&#8663;]</a> ).</p>
					<section class='internal'>
						<h6>Для Пользователя есть 3 варианта пользовательских настроек:</h6>
						<ul>
							<li>Настройки по умолчанию.</li>
							<li>Настройки, выбранные Пользователем как базовые для всех своих устройств.</li>
							<li>Настройки для текущего устройства.</li>
						</ul>
					</section>
					<p>Пока Пользователь не сделал выбор какой-либо пользовательской настройки у него будет применяться настройка, выбранная при разработке сервиса.</p>
					<p>Если при выборе какой-либо настройки не ставится флажок "Только для этого устройства", то в пользовательской базе данных выбранная настройка сохраняется как базовая для всех устройств, на которых Пользователь работает с сервисом.</p>
				</article>
				<article data-folder-idtotal='2' data-idlocal='5' class='item'>
					<h4 class='item-h4-notes'>Текущие дефекты к исправлению.</h4>
					<p>Разработчик будет признателен пользователям сервиса за информацию о замеченных ошибках в работе программы и пожелания.</p>
				</article>
				<article data-folder-idtotal='2' data-idlocal='6' class='item'>
					<h4 class='item-h4-notes'>В планах.</h4>
					<ul>
						<li>Увеличение количества пользовательских настроек.</li>
						<li>Создание информационного блока "Календарь", в котором будет возможность записывать события по датам.</li>
						<li>Реализация возможности отображения Статей не только в текущей, но и во вложенных Папках.</li>
						<li>Создание "Корзины".</li>
					</ul>
				</article>
			</section>
			<section class='itemsfolder' data-folder-idtotal='3'>
				<header>
					<div>
						<button class='toggle-folderstree-button js-only'>&#9776;</button>
					</div>
					<div class='items-header'>
						<h2 class='items-h2'>Авторизация</h2>
					</div>
				</header>
				<article data-folder-idtotal='3' data-idlocal='1' class='item'>
					<h4 class='item-h4-notes'>Регистрация нового Пользователя в системе.</h4>
					<p>При регистрации нового Пользователя в системе необходимо выбрать соответствующий режим в авторизационной форме и ввести адрес своей электронной почты. На данную почту придёт пароль и идентификационный номер Пользователя в системе (ID).</p>
					<p>И электронную почту, и пароль Пользователь в любой момент может сменить на странице настроек.</p>
					<p>Электронная почта в обязательном порядке требуется для операций восстановления и смены пароля.</p>
					<p>Электронная почта является уникальным значением в системе, следовательно, использование одного и того же адреса почты для разных Пользователей недопустимо.</p>
					<p>Сменить адрес электронной почты, пароль и сделать запрос на удаление Пользователя можно в соответствующем разделе страницы настроек ( <a href='/screenshots/options_auth.png' target='_blank'>скриншот [&#8663;]</a> ).</p>
				</article>
				<article data-folder-idtotal='3' data-idlocal='2' class='item'>
					<h4 class='item-h4-notes'>Вход в систему.</h4>
					<p>В качестве логина для входа в систему может использоваться как ID, так и электронная почта.</p>
					<p>Современные браузеры предоставляют возможность запомнить логин и пароль Пользователя для ресурса.</p>
					<p>Автоматический вход в систему пока не реализован.</p>
				</article>
				<article data-folder-idtotal='3' data-idlocal='3' class='item'>
					<h4 class='item-h4-notes'>Восстановление пароля.</h4>
					<p>Для восстановления утеряного пароля необходимо выбрать соответствующий режим в авторизационной форме и ввести ID или адрес электронной почты.</p>
					<p>На электронную почту Пользователя придёт письмо с новым паролем. Старый пароль уже будет недействителен.</p>
				</article>
				<article data-folder-idtotal='3' data-idlocal='4' class='item'>
					<h4 class='item-h4-notes'>Смена адреса электронной почты.</h4>
					<p>Смена адреса происходит в 2 этапа.</p>
					<p>Сначала Пользователь вводит новый адрес. Адрес проверяется на уникальность в системе, и в случае успешного результата на него отправляется письмо с кодом подтверждения.</p>
					<p>Данный код необходимо ввести в соседнее поле. Только после такого подтверждения у Пользователя меняется зарегистрированный адрес электронной почты.</p>
					<p>Пароль для входа в систему при этой операции не меняется.</p>
				</article>
				<article data-folder-idtotal='3' data-idlocal='5' class='item'>
					<h4 class='item-h4-notes'>Смена пароля.</h4>
					<p>Смена пароля происходит после ввода нового пароля в соответствующее поле и нажатия кнопки подтверждения.</p>
					<p>При желании новый пароль может быть направлен на электронную почту. Для этого необходим установленный соответствующий флажок.</p>
				</article>
				<article data-folder-idtotal='3' data-idlocal='6' class='item'>
					<h4 class='item-h4-notes'>Удаление аккаунта Пользователя.</h4>
					<p>Перед началом процедуры удаления Пользователю необходимо удалить все свои пользовательские данные (закладки, заметки и т.п.)</p>
					<p>Затем на странице настроек генерируется код подтверждения, который отправляется на адрес электронной почты. После ввода кода направляется письмо с запросом администратору системы.</p>
					<p>Удаление аккаунта Пользователя производится администратором вручную после проверки того, что удалены все пользовательские данные Пользователя. Сложность этой процедуры вызвана необходимостью минимизации рисков потери пользовательских данных из-за программных ошибок и ошибочных действий Пользователя.</p>
				</article>
			</section>
			<section class='itemsfolder' data-folder-idtotal='4'>
				<header>
					<div>
						<button class='toggle-folderstree-button js-only'>&#9776;</button>
					</div>
					<div class='items-header'>
						<h2 class='items-h2'>Контакты</h2>
					</div>
				</header>
				<article data-folder-idtotal='4' data-idlocal='1' class='item'>
					<h4 class='item-h4-notes'>Электронная почта администратора системы.</h4>
					<address>Электронная почта разработчика и администратора сервиса: <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a> .</address>
					<p>По всем вопросам работы сервиса просим обращаться по вышеуказанному адресу.</p>
				</article>
				<article data-folder-idtotal='4' data-idlocal='2' class='item'>
					<h4 class='item-h4-notes'>Автоматические письма системы.</h4>
					<p>Адрес электронной почты администратора будет указан в качестве получателя при ответе на сообщения, автоматически присылаемые системой, где в качестве отправителя указан <em>robot@personalorg.ru</em> .</p>
					<p>Администратор не знает пароли и не может их посмотреть, т.к. они хранятся в зашифрованном виде. Конкретный пароль не требуется для решения проблем, поэтому просим при пересылке писем от Робота заменять направленный пароль на **** .</p>
				</article>
			</section>
		</section>
	</main>
	<footer>
		<address>PersonalOrg.ru 2019, <a href='mailto:admin@personalorg.ru' target='_blank'>admin@personalorg.ru</a></address>
	</footer>
</body>
</html>
