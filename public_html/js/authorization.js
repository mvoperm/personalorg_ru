import {passwordShowHide, authFormOnsubmit} from './subs_auth.js';

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
