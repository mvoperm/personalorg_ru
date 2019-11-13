/* СКРИПТЫ ОБЩЕГО НАЗНАЧЕНИЯ (для страницы контента) */

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

// Получение IdTotal Родителя и Папки
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
		case '0':
			const folderToopen = destinationFolderIdtotal;
			return folderToopen;
		default:
			if (destinationFolderIdtotal === '0')	{
				const folderToopen = destinationIdlocal;
				return folderToopen;
			} else	{
				let folderToopen = destinationFolderIdtotal + '-' + destinationIdlocal;
				if (getInputValueFromId('editform-element-edit-type') === 'add') {return folderToopen;}
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

// 2.1. Установка максимального значения счётчика Setnumber (количество детей у заданной папки типа Папка или Статья) - только для add и relocate
const setMaxElementsQuantity = (folderIdtotal, elementToeditType, isSameFolder) => {
	const totalTreeIdValue = (elementToeditType === 'folder') ? 'folderstree' : 'items';
	const querySelectorTagName = (elementToeditType === 'folder') ? 'summary' : 'section';
	const tagName = (elementToeditType === 'folder') ? 'details' : 'article';

	const totalTree = document.getElementById(totalTreeIdValue);
	const querySelectorString = `${querySelectorTagName}[data-folder-idtotal='${folderIdtotal}']`;
	const folderTocalculate = (elementToeditType === 'folder') ? totalTree.querySelector(querySelectorString).parentNode : totalTree.querySelector(querySelectorString);
	const elementsByTagTocalculate = folderTocalculate.querySelectorAll(tagName);

	let elementsQuantity = 1 - isSameFolder; // Учитывает добавляемый или перемещаемый Элемент, если он из другой папки
	for (let item of elementsByTagTocalculate)	{
		if (item.parentNode === folderTocalculate)	{elementsQuantity += 1;}
	}

	const elementOrderSetnumber = document.getElementById('relocation-order-setnumber');
	elementOrderSetnumber.value = (elementOrderSetnumber.value > elementsQuantity) ? elementsQuantity : elementOrderSetnumber.value;
	elementOrderSetnumber.setAttribute('max', elementsQuantity);
	setInputValueFromId('editform-maxordernumber', elementsQuantity);

	// Вычисление наличия Статей, если Элемент - Папка
	if (elementToeditType == 'folder')	{
		const hasFolders = document.getElementById('editform-has-folders');
		hasFolders.setAttribute('value', elementsQuantity > 1);
		const hasItems = document.getElementById('editform-has-items');
		const itemsTree = document.getElementById('items');
		const itemsQuerySelectorString = `section[data-folder-idtotal='${folderIdtotal}']`;
		const itemsFolderTocalculate = itemsTree.querySelector(itemsQuerySelectorString);
		hasItems.setAttribute('value', itemsFolderTocalculate.querySelector('article') !== null);
	}
	return elementsQuantity;
};
// 2.2. Изменение счётчика порядкового номера - только для add и relocate
const changeFolderToopen = () => {
	const elementToEditTypeAttr = getInputValueFromId('editform-element-toedit-type');
	const numberOrderSetnumber = document.getElementById('relocation-order-setnumber');
	const numberOrderSetnumberValue = (elementToEditTypeAttr === 'folder') ? numberOrderSetnumber.value : '0';
	const parentFolderIdtotal = getInputValueFromId('editform-parentfolder-idtotal');
	const folderToopen = getFolderToopen(parentFolderIdtotal, numberOrderSetnumberValue);
	document.getElementById('editform-folder-tooppen').value = folderToopen;
};

export {getInputValueFromId, setInputValueFromId, checkElement, checkElementById, getParentFolderIdtotal, getFolderIdlocal, getFolderToopen, setMaxElementsQuantity, changeFolderToopen};
