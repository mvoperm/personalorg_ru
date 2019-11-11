import {checkEmail, checkInteger} from './subs_general.js';

// Отображение / скрытие пароля (mode: 2 - toggle, 0 - hide)
const passwordShowHide = (mode = 2) => {
	const passwordInput = document.getElementById('password');
	let passwordInputType = passwordInput.getAttribute('type');
	const passwordToggleButton = document.getElementById('toggle-password-type');
	passwordToggleButton.innerHTML = ((mode === 2 && passwordInputType === 'text') || mode === 0) ? 'Показать пароль' : 'Скрыть пароль';
	passwordInputType = ((mode === 2 && passwordInputType === 'text') || mode === 0) ? 'password' : 'text';
	passwordInput.setAttribute('type', passwordInputType);
};

// Проверка правильности ввода логина
const loginCheck = () => {
	const loginInput = document.getElementById('login');
	const loginInputValue = loginInput.value;
	const submitButton = document.getElementById('submit');
	let result = checkEmail(loginInputValue) || (checkInteger(loginInputValue) && submitButton.innerHTML !== 'Зарегистрироваться' && parseInt(loginInputValue) > 0);
	console.log(result);
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

export {passwordShowHide, loginCheck, authFormOnsubmit};
