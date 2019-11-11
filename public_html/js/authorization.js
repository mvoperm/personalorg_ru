import {selectMode, passwordShowHide, authFormOnsubmit} from './subs_auth.js';

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
