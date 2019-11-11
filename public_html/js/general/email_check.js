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

export {checkEmail};
