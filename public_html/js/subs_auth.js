import {checkEmail, checkInteger} from './subs_general.js';

// Выбор режима авторизации (вход в систему, регистрация или восстановление пароля)
const selectMode = (mode) => {
	const modeValue = mode.getAttribute('value');
	const loginInput = document.getElementById('login');
	const loginTitle = document.getElementById('login-title');
	const loginComment = document.getElementById('login-comment');
	const passwordInput = document.getElementById('password');
	const passwordRecoveryComment = document.getElementById('password-recovery-comment');
	const passwordLabel = document.getElementById('password-label');
	//const rememberMeLabel = document.getElementById('remember-me-label');
	const submitButton = document.getElementById('submit');
	const loginInputType = (modeValue === 'user_signin') ? 'email' : 'text';
	loginInput.setAttribute('type', loginInputType);
	loginTitle.innerHTML = (modeValue === 'user_signin') ? 'Адрес электронной почты:' : 'ID или адрес электронной почты:';
	loginComment.style.display = (modeValue === 'user_signin') ? 'block' : 'none';
	passwordRecoveryComment.style.display = (modeValue === 'user_login') ? 'none' : 'block';
	passwordLabel.style.display = (modeValue === 'user_login') ? 'block' : 'none';
	//rememberMeLabel.style.display = (modeValue == 'password_recovery') ? 'none' : 'block'; // к дальнейшей проработке
	switch (modeValue)	{
		case 'user_login':
			const requiredAttr = document.createAttribute('required');
			passwordInput.setAttributeNode(requiredAttr);
			submitButton.innerHTML = 'Войти';
			break;
		case 'user_signin':
			passwordInput.removeAttribute('required');
			submitButton.innerHTML = 'Зарегистрироваться';
			break;
		case 'password_recovery':
			passwordInput.removeAttribute('required');
			submitButton.innerHTML = 'Восстановить пароль';
			break;
	}
};

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

export {selectMode, passwordShowHide, loginCheck, authFormOnsubmit};
