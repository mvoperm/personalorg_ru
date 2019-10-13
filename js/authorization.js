import {selectMode, passwordShowHide, authFormOnsubmit} from './subs_auth.js';

// Отображение блоков, которые не должны отображаться без поддержки JS
{
	const styleEl = document.getElementById('js-enabled');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	styleSheet.insertRule('.js-only {display: block;}', 0);
	styleSheet.insertRule('.js5 {display: none;}', 1);
}
// Проверка поддержки браузером элемента dialog
{
	const dialogEl = document.getElementById('dialog-element');
	if (dialogEl.open !== false)	{
		let dialogAlert = document.getElementById('dialog-alert');
		dialogAlert.style.display = 'block';
		const dialElements = document.getElementsByClassName('dialog-only');
		for (let item of dialElements)	{
			item.setAttribute('disabled', '');
		}
	}
}

// Выбор режима авторизации
{
	const radiosHTMLCol = document.getElementsByName('authorization_action');
	const radios = Array.from(radiosHTMLCol);
	radios.forEach((item) => {
		item.addEventListener('click', () => {selectMode(item);});
	});
}
// Отображение/скрытие пароля
{
	const toggleButton = document.getElementById('toggle-password-type');
	const pwInput = document.getElementById('password');
	toggleButton.addEventListener('click', () => {passwordShowHide();});
	pwInput.addEventListener('blur', () => {passwordShowHide(0);});
}
// Валидация формы
{
	const authForm = document.getElementById('authorization-form');
	authForm.addEventListener('submit', authFormOnsubmit, false);
}
// Установка значения поля поддержки сенсорных событий экрана
{
	const touchscreenCheckInput = document.getElementById('touchscreen-value');
	touchscreenCheckInput.value = ('ontouchstart' in window) ? 'sensor' : 'no-sensor';
}