/* ФУНКЦИИ ОБЩЕГО НАЗНАЧЕНИЯ */

// Проверка, является ли строка электронной почтой
const checkEmail = (str) => {
	let result = false;
	if (str.includes('@'))	{
		const atIndex = str.indexOf('@');
		const strLength = str.length;
		const firstCheck = (atIndex > 0) && (atIndex < strLength - 1);
		if (firstCheck)	{
			const sub = str.substr(atIndex + 1);
			result = (!sub.includes('@'));
		}
	}
	return result;
};

// Проверка, является ли строка целым числом
const checkInteger = (str) => {
	// Популярная версия проверки, а была собственная (первые два условия): ((+loginInputValue)/(+loginInputValue)) && (+loginInputValue) > 0 && ((+loginInputValue) % Math.floor(+loginInputValue)) < 1e-8
	let result = !isNaN(parseInt(str)) && isFinite(str);
	return result;
};

export {checkEmail, checkInteger};
