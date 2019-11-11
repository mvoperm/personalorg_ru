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

// Чтение и установка переменных, задаваемых Пользователем
(async () =>	{
// Получение основных констант
const cssVar = document.getElementById('css-variables');
const userId = cssVar.getAttribute('data-user-id');
const userFolder = cssVar.getAttribute('data-user-folder');
let responseDefault = await fetch('../users/optionslist_default.json');
let optionsDefault = await responseDefault.json();
let responseUser = await fetch(`../users/${userFolder}/optionslist.json`);
let optionsUser = await responseUser.json();

const cssRulesList = [
	['--basic-color-hue', 'basic_hue'],
	['--article-tranparency', 'article_transparency'],
	['--body-bg-image', 'bg_image'],
	['--basic-font-type', 'basic_font_type'],
	['--basic-font-size', 'basic_font_size'],
];
const styleSheet = cssVar.sheet;
let defObject = {};
let optObject = {};

// Получение данных файла JSON с общими настройками
{
	for (let item of cssRulesList)	{
		defObject[item[1]/*ключ*/] = optionsDefault[item[1]] /*значение*/;
		if (userId === '0')	{optObject[item[1]] = defObject[item[1]];} // Для файла index.php
	}
}

// Получение данных файла JSON с пользовательскими настройками (кроме файла index.php)
if (userId !== '0')	{
	for (let item of cssRulesList)	{
		optObject[item[1]] = optionsUser[item[1]] || defObject[item[1]]; /* на случай введения нового свойства */
	}
}

// Получение строки с куки Пользователя
const ckObject = getUserCockie(userId); // Из подпрограммы

// Формирование строки для селектора ':root' из настраиваемых параметров
let allRules = '';
for (let item of cssRulesList)	{
	let key = item[1];
	let value = ((key in ckObject) && (userId != '0')) ? ckObject[key] : optObject[key];
	if (key === 'bg_image' && value !== '0')	{value = `url(../bg-images/${value})`;} // Название рисунка превращается в URI
	if (String(value).includes(' '))	{value = `'${value}'`;} // Для свойства из нескольких слов
	if (key === 'basic_font_size')	{value += 'px';} // Добавляется единица измерения (px)
	allRules += `${item[0]}: ${value}; `;
	if (key === 'bg_image')	{ // Проверка, нужно ли устанавливать повторение рисунка
		if (!value.includes('-repeat.'))	{
			allRules += '--body-bg-repeat: no-repeat; '
		}
	}
}

// Формирование строки для селектора ':root' из постоянных параметров
allRules += '--folderstree-width: 15em; '; // Ширина раздела с деревом папок

// Определение и установка правила для селектора :root'
const ruleToadd = `:root { ${allRules}}`;
styleSheet.insertRule(ruleToadd, 0);

})();
