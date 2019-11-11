// Функция отображения/скрытия пароля (mode: 2 - toggle, 0 - hide)

const passwordShowHide = (mode = 2) => {
	const passwordInput = document.getElementById('password');
	let passwordInputType = passwordInput.getAttribute('type');
	const passwordToggleButton = document.getElementById('toggle-password-type');
	passwordToggleButton.innerHTML = ((mode === 2 && passwordInputType === 'text') || mode === 0) ? 'Показать пароль' : 'Скрыть пароль';
	passwordInputType = ((mode === 2 && passwordInputType === 'text') || mode === 0) ? 'password' : 'text';
	passwordInput.setAttribute('type', passwordInputType);
};

export {passwordShowHide};
