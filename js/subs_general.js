/* ФУНКЦИИ ОБЩЕГО НАЗНАЧЕНИЯ */

// Получение куки авторизовавшегося Пользователя
const getUserCockie = (userId) => {
	const ckString = document.cookie;
	const ckArray = ckString.split('; ');
	let userCkString = '';
	
	for (let item of ckArray)	{
		if (item.includes('_'))	{
			let separatorPos = item.indexOf('_');
			let id = item.substr(0, separatorPos);
			if (id === userId)	{
				let str = item.substr(separatorPos + 1);
				userCkString += `${str} `;
			}
		}
	}
	if (userCkString !== '')	{userCkString = userCkString.substr(0, userCkString.length - 1);}
	
	const userCkArray = userCkString.split(' ');
	let ckObject = {};
	for (let phrase of userCkArray)	{
		let separatorPos = phrase.indexOf('=');
		let key = phrase.substring(0, separatorPos);
		let value = phrase.substring(separatorPos + 1);
		ckObject[key] = value;
	}
	return ckObject;
};

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

export {getUserCockie, checkEmail, checkInteger};