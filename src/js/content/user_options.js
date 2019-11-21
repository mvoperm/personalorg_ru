import {checkInteger} from '../general/integer_check.js';
import {passwordShowHide} from '../general/password_toggle.js';

if (!document.getElementById('editform')) {
// Отображение / скрытие пароля
{
	const toggleButton = document.getElementById('toggle-password-type');
	const pwInput = document.getElementById('password');
	toggleButton.addEventListener('click', () => {passwordShowHide();});
	pwInput.addEventListener('blur', () => {passwordShowHide(0);});
}

// Проверка устанавливаемых цвета и прозрачности
{
	let bgColorSet = (el, bgHue, bgTransp) => {
		let bgColor = `hsla(${bgHue},100%,85%,${bgTransp/100})`;
		el.style.backgroundColor = bgColor;
	};
	const bgHueRange = document.getElementById('bg-hue');
	const bgTranspRange = document.getElementById('bg-transparency');
	const bgHueText = document.getElementById('bg-hue-value');
	const bgTranspText = document.getElementById('bg-transparency-value');
	const bgCheck = document.getElementById('check-bg-color');

	let setColor = () => {return bgColorSet(bgCheck, bgHueRange.value, bgTranspRange.value);};
	setColor();

	let setHueText = () => {bgHueText.value = bgHueRange.value; setColor();};
	bgHueRange.addEventListener('change', setHueText);
	let setHueRange = () => {bgHueRange.value = bgHueText.value; setColor();};
	bgHueText.addEventListener('change', setHueRange);
	let setTranspText = () => {bgTranspText.value = bgTranspRange.value; setColor();};
	bgTranspRange.addEventListener('change', setTranspText);
	let setTranspRange = () => {bgTranspRange.value = bgTranspText.value; setColor();};
	bgTranspText.addEventListener('change', setTranspRange);
}

// Установка/снятие флажка синхронизации цвета и прозрачности с настройками на сервере
{
	const ckColorDelete = document.getElementById('ck-article-color-delete');
	const ckColorSet = document.getElementById('ck-article-color');
	let toggleCkColorSetValue = () => {
		ckColorSet.checked = !ckColorDelete.checked;
		ckColorSet.disabled = ckColorDelete.checked;
	};
	ckColorDelete.addEventListener('click', toggleCkColorSetValue);
}

// Проверка правильности введённых значений в текстовые поля настройки цветового фона
{
	const setColorOnsubmit = (e) => {
		let result = false;
		const hueInput = document.getElementById('bg-hue-value');
		const transparencyInput = document.getElementById('bg-transparency-value');
		const hueInputValue = hueInput.value;
		const transparencyInputValue = transparencyInput.value;

		if (checkInteger(hueInputValue) && checkInteger(hueInputValue))	{
			result = (parseInt(hueInputValue) >= 0 && parseInt(hueInputValue) <= 360 && parseInt(transparencyInputValue) >= 0 && parseInt(transparencyInputValue) <= 100);
		}
		if (!result)	{
			e.preventDefault();
			alert('В поле насыщенности и/или прозрачности введено недопустимое значение!');
		}
	}

	const formSetColor = document.getElementById('set-article-color');
	formSetColor.addEventListener('submit', setColorOnsubmit, false);
}

// Проверка устанавливаемого базового шрифта
{
	const basicFontSet = (el, fontTypeValue, fontSizeValue) => {
		el.style.fontFamily = fontTypeValue;
		el.style.fontSize = fontSizeValue + 'px';
	};
	const fontTypeEl = document.getElementById('basic-font-type');
	const fontSizeEl = document.getElementById('basic-font-size');
	const fontCheck = document.getElementById('check-basic-font');

	let setFont = () => {return basicFontSet(fontCheck, fontTypeEl.value, fontSizeEl.value);};
	setFont(); // ВРЕМЕННО -> ЗАДАТЬ СТИЛЯМИ

	fontTypeEl.addEventListener('change', setFont);
	fontSizeEl.addEventListener('change', setFont);
}

// Установка/снятие флажка синхронизации базового шрифта с настройками на сервере
{
	const ckFontDelete = document.getElementById('ck-basic-font-delete');
	const ckFontSet = document.getElementById('ck-basic-font');
	let toggleCkFontSetValue = () => {
		ckFontSet.checked = !ckFontDelete.checked;
		ckFontSet.disabled = ckFontDelete.checked;
	};
	ckFontDelete.addEventListener('click', toggleCkFontSetValue);
}

// Заполнение поля выбранного фонового рисунка по щелчку
{
	const fgInitialClassName = 'fg-images-collection';
	const bgImageFileInput = document.getElementById('bg-image-file');
	const bgImagesDiv = document.getElementById('bg-images-collection');
	const bgImagesList = bgImagesDiv.getElementsByTagName('figure');
	const bgImagesListLength = bgImagesList.length;
	let chooseImage = (filename) => {
		bgImageFileInput.value = filename;
		for (let item of bgImagesList)	{
			if (item.getAttribute('class').includes('choosed-bg-image')) {item.setAttribute('class', fgInitialClassName);}
		}
	};
	for (let item of bgImagesList)	{
		let filename = item.getAttribute('title');
		let set = () => {
			chooseImage(filename);
			item.setAttribute('class', `${fgInitialClassName} choosed-bg-image`);
		};
		item.addEventListener('click', set);
	}
}

// Установка/снятие флажка очистки/установки фонового рисунка
{
	const deleteBgImage = document.getElementById('delete-bg-image');
	let setSubmitText = () => {
		const elSubmit = document.getElementById('submit-bg-image');
		elSubmit.innerHTML = (deleteBgImage.checked) ? 'Удалить фоновый рисунок' : 'Выбрать фоновый рисунок';
	};
	deleteBgImage.addEventListener('click', setSubmitText);
}

// Установка/снятие флажка синхронизации фонового рисунка с настройками на сервере
{
	const ckBgImageDelete = document.getElementById('ck-bg-image-delete');
	const ckBgImageSet = document.getElementById('ck-bg-image');
	const deleteBgImage = document.getElementById('delete-bg-image');
	let toggleBgImageSetValue = () => {
		ckBgImageSet.disabled = ckBgImageDelete.checked;
		ckBgImageSet.checked = !ckBgImageDelete.checked;
		deleteBgImage.disabled = ckBgImageDelete.checked;
		deleteBgImage.checked = false;
	};
	ckBgImageDelete.addEventListener('click', toggleBgImageSetValue);
}

}
