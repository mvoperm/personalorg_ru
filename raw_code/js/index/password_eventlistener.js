import {passwordShowHide} from '../general/password_toggle.js';

// Назначение события отображения/скрытия пароля
{
	const toggleButton = document.getElementById('toggle-password-type');
	const pwInput = document.getElementById('password');
	toggleButton.addEventListener('click', () => {passwordShowHide();});
	pwInput.addEventListener('blur', () => {passwordShowHide(0);});
}
