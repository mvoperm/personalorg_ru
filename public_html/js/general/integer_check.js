// Проверка, является ли строка целым числом

const checkInteger = (str) => {
	// Популярная версия проверки, а была собственная (первые два условия): ((+loginInputValue)/(+loginInputValue)) && (+loginInputValue) > 0 && ((+loginInputValue) % Math.floor(+loginInputValue)) < 1e-8
	let result = !isNaN(parseInt(str)) && isFinite(str);
	return result;
};

export {checkInteger};
