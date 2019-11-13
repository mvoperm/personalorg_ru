import {checkEmail} from '../general/email_check.js';
import {checkInteger} from '../general/integer_check.js';
import {passwordShowHide} from '../general/password_toggle.js';

// Проверка правильности ввода логина
const loginCheck = () => {
	const loginInput = document.getElementById('login');
	const loginInputValue = loginInput.value;
	const submitButton = document.getElementById('submit');
	let result = checkEmail(loginInputValue) || (checkInteger(loginInputValue) && submitButton.innerHTML !== 'Зарегистрироваться' && parseInt(loginInputValue) > 0);
	return result;
};

// Действия и проверки перед отправкой формы авторизации
const authFormOnsubmit = (e) => {
	passwordShowHide(0);
	if (loginCheck() === false)	{
		e.preventDefault();
		alert('В поле логина введено недопустимое значение!');
	}
};

// Валидация формы
{
	const authForm = document.getElementById('authorization-form');
	authForm.addEventListener('submit', authFormOnsubmit, false);
}
