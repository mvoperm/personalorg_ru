/* ВСПОМОГАТЕЛЬНЫЕ СКРИПТЫ */

// Получение 1-го VALUE элемента INPUT по ID (1); установление его VALUE (2).
const getInputValueFromId = (id) => {
	const inputEl = document.getElementById(id);
	const inputValue = inputEl.getAttribute('value');
	return inputValue;
};
const setInputValueFromId = (id, inputValue) => {
	const inputEl = document.getElementById(id);
	inputEl.setAttribute('value', inputValue);
};

// Программное выделение элемента
const checkElement = (elementNode) => {
	const varEvent = new Event('click');
	elementNode.dispatchEvent(varEvent);
};
const checkElementById = (id) => {
	const inputElement = document.getElementById(id);
	checkElement(inputElement);
};

// Получение IdTotal Папки и Родителя
const getParentFolderIdtotal = (dataFolderIdtotalAttr) => {
	const i = dataFolderIdtotalAttr.lastIndexOf('-');
	const dataParentFolderId = (i === -1) ? '0' : dataFolderIdtotalAttr.substring(0, i);
	return dataParentFolderId;
};
const getFolderIdlocal = (dataFolderIdtotalAttr) => {
	const i = dataFolderIdtotalAttr.lastIndexOf('-');
	const dataFolderIdlocal = (i === -1) ? dataFolderIdtotalAttr : dataFolderIdtotalAttr.substring(i + 1);
	return dataFolderIdlocal;
};

// Получение Папки к отображению
const getFolderToopen = (parentFolderIdtotal, folderIdlocal) => { // folderIdlocal у Статей присваивается равным 0
	switch (folderIdlocal)	{
		case 0:
			const folderToopen = parentFolderIdtotal;
			return folderToopen;
		default:
			if (parentFolderIdtotal === '0')	{
				const folderToopen = folderIdlocal;
				return folderToopen;
			} else	{
				let dataEditTypeAttr = getInputValueFromId('editform-element-edit-type');
				if (dataEditTypeAttr === 'relocate')	{ // Проверка случая перемещения папки в нижестоящую папку одного уровня
					const grandparentFolderIdtotal = getParentFolderIdtotal(parentFolderIdtotal); // Родитель конечной папки
					const parentFolderIdlocal = getFolderIdlocal(parentFolderIdtotal);
					const dataFolderIdtotalAttr = getInputValueFromId('editform-currentfolder-idtotal');
					if (getParentFolderIdtotal(dataFolderIdtotalAttr) === grandparentFolderIdtotal &&
							getFolderIdlocal(dataFolderIdtotalAttr) < parentFolderIdlocal)	{
						parentFolderIdtotal = (grandparentFolderIdtotal === '0') ? (parentFolderIdlocal - 1) : grandparentFolderIdtotal + '-' + (parentFolderIdlocal - 1);
					}
				}
				const folderToopen = parentFolderIdtotal + '-' + folderIdlocal;
				return folderToopen;
			}
	}
};

// Отображение/скрытие дерева папок
const toggleFolderstree = () => {
	const mainEl = document.getElementsByTagName('main')[0];
	mainEl.classList.toggle('reverse-display-mode');
};

export {getInputValueFromId, setInputValueFromId, checkElement, checkElementById, getParentFolderIdtotal, getFolderIdlocal, getFolderToopen, toggleFolderstree};
