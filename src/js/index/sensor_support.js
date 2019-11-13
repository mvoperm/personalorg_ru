// Установка значения поля поддержки сенсорных событий экрана
{
	const touchscreenCheckInput = document.getElementById('touchscreen-value');
	touchscreenCheckInput.value = ('ontouchstart' in window) ? 'sensor' : 'no-sensor';
}
