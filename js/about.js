// Скрипты для страницы "О ресурсе"
{
	const styleEl = document.getElementById('noscript-disable');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	styleSheet.insertRule('.js-only {display: block;}', 0);
	styleSheet.insertRule('#folderstree {display: block;}', 1);
	styleSheet.insertRule(':root {--folderstree-width: 250px;}', 2);
	styleSheet.insertRule('.itemsfolder {display: none;}', 3);
	styleSheet.insertRule('.js5 {display: none;}', 4);
}
{
	const dialogEl = document.getElementById('dialog-element');
	const dialogAlertPar = document.getElementById('dialog-alert');
	const alertText = (dialogEl.open !== false) ? '<span class="warning">Ваш бразуер не поддерживает элемент <code>dialog</code></span>.<br />Если Вы пользуетесь браузером Firefox для настольного компьютера, то эту поддержку можно включить (см. информацию ниже).' : '<span class="ok">Ваш браузер поддерживает элемент <code>dialog</code></span>.';
	dialogAlertPar.innerHTML = alertText;
}