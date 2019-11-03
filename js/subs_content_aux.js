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
const getFolderToopen = (destinationFolderIdtotal, destinationIdlocal) => { // destinationIdlocal у Статей присваивается равным 0
	switch (destinationIdlocal)	{
		case 0:
			const folderToopen = destinationFolderIdtotal;
			return folderToopen;
		default:
			if (destinationFolderIdtotal === '0')	{
				const folderToopen = destinationIdlocal;
				return folderToopen;
			} else	{
				let folderToopen = destinationFolderIdtotal + '-' + destinationIdlocal;
				const currentIdlocal = getInputValueFromId('editform-idlocal');
				const currentParentIdtotal = getInputValueFromId('editform-currentparent-idtotal');
				const currentParentIds = currentParentIdtotal.split('-');
				const currentParentIdsLength = currentParentIds.length;
				const destinationFolderIds = destinationFolderIdtotal.split('-');
				if (currentParentIdtotal === '0') {
					if (currentIdlocal < destinationFolderIds[0]) {
						destinationFolderIds[0] = String(Number(destinationFolderIds[0]) - 1);
						let destinationFolderIdtotalNew = destinationFolderIds.join('-');
						folderToopen = destinationFolderIdtotalNew + '-' + destinationIdlocal;
					}
					return folderToopen;
				}
				if (currentParentIdsLength < destinationFolderIds.length) {
					for (var i = 0; i < currentParentIdsLength; i++) {
						if (currentParentIds[i] !== destinationFolderIds[i]) {return folderToopen;}
					}
					if (currentIdlocal < destinationFolderIds[currentParentIdsLength]) {
						destinationFolderIds[currentParentIdsLength] = String(Number(destinationFolderIds[currentParentIdsLength]) - 1);
						let destinationFolderIdtotalNew = destinationFolderIds.join('-');
						folderToopen = destinationFolderIdtotalNew + '-' + destinationIdlocal;
					}
				}
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
