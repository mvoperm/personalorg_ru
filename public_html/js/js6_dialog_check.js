// Скрипты для страниц Авторизации и "О ресурсе"

{ // Установка правил, отменяющих правила noscript
	const styleEl = document.getElementById('noscript-disable');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	styleSheet.insertRule('.js-only {display: block;}', 0);
	styleSheet.insertRule('.js5 {display: none;}', 1);
	// Следующие правила только для страницы "О ресурсе"
	styleSheet.insertRule('#folderstree {display: block;}', 2);
	styleSheet.insertRule(':root {--folderstree-width: 250px;}', 3);
	styleSheet.insertRule('.itemsfolder {display: none;}', 4);
}

// Проверка поддержки браузером элемента dialog
{
	const dialogEl = document.getElementById('dialog-element');
	// Следующие правила только для страницы "О ресурсе"
	if (document.getElementById('dialog-alert-about') !== null) {
		let dialogAlertPar = document.getElementById('dialog-alert-about');
		const alertText = (dialogEl.open !== false) ? '<span class="warning">Ваш бразуер не поддерживает элемент <code>dialog</code></span>.<br />Если Вы пользуетесь браузером Firefox для настольного компьютера, то эту поддержку можно включить (см. информацию ниже).' : '<span class="ok">Ваш браузер поддерживает элемент <code>dialog</code></span>.';
		dialogAlertPar.innerHTML = alertText;
	}
	// Следующие правила только для страницы Авторизации
	if (document.getElementById('dialog-alert-index')) {
		if (dialogEl.open !== false)	{
			let dialogAlert = document.getElementById('dialog-alert-index');
			dialogAlert.style.display = 'block';
			const dialElements = document.getElementsByClassName('dialog-only');
			for (let item of dialElements)	{
				item.setAttribute('disabled', '');
			}
		}
	}
}
