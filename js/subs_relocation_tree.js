import {getInputValueFromId, setInputValueFromId, checkElement, getParentFolderIdtotal, getFolderToopen} from './subs_content_aux.js';

/* 2. ОТОБРАЖЕНИЕ И ЗАКРЫТИЕ РАМКИ ДЕРЕВА ДЛЯ ПЕРЕМЕЩЕНИЯ И ДОБАВЛЕНИЯ - только для add и relocate */

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
// 2.3. Установка переключателя 'в начало папки' - только для add и relocate
const checkedRadioFirstOrdernumber = () => {
	const inputNumberOrdernumber = document.getElementById('relocation-order-setnumber');
	inputNumberOrdernumber.value = 1;
	changeFolderToopen();
};
// 2.4. Установка переключателя 'в конец папки' - только для add и relocate
const checkedRadioLastOrdernumber = () => {
	const inputNumberOrdernumber = document.getElementById('relocation-order-setnumber');
	const elementsQuantity = inputNumberOrdernumber.getAttribute('max');
	inputNumberOrdernumber.value = elementsQuantity;
	changeFolderToopen();
};
// 2.5. Установка переключателя 'задать порядковый номер' - только для add и relocate
const checkedRadioOrderSetnumber = () => {
	const inputNumberOrdernumber = document.getElementById('relocation-order-setnumber');
	inputNumberOrdernumber.focus();
};
// 2.6. Установка переключателя 'в пределах папки' - только для relocate
const checkedRadioInfolder = () => {
	const dataEditTypeAttr = getInputValueFromId('editform-element-edit-type');
	const elementToEditTypeAttr = getInputValueFromId('editform-element-toedit-type');
	const dataFolderIdtotalAttr = getInputValueFromId('editform-currentfolder-idtotal');
	const dataParentFolderIdtotal = (elementToEditTypeAttr === 'folder') ? getParentFolderIdtotal(dataFolderIdtotalAttr) : dataFolderIdtotalAttr;
	setInputValueFromId('editform-parentfolder-idtotal', dataParentFolderIdtotal);
	hideRelocationTree();
	const maxElementsQuantity = setMaxElementsQuantity(dataParentFolderIdtotal, elementToEditTypeAttr, 1);
	changeFolderToopen();
};
// 2.7. Установка переключателя - только для relocate
const checkedDestinationFolder = (elementDestinationFolder) => {
	const dataEditTypeAttr = getInputValueFromId('editform-element-edit-type');
	const elementToEditTypeAttr = getInputValueFromId('editform-element-toedit-type');
	const dataDestinationFolderIdtotalAttr = elementDestinationFolder.getAttribute('value');
	setInputValueFromId('editform-parentfolder-idtotal', dataDestinationFolderIdtotalAttr);
	const dataCurrentFolderIdtotalAttr = getInputValueFromId('editform-currentfolder-idtotal');
	const dataCurrentParentIdtotal = (elementToEditTypeAttr === 'folder') ? getParentFolderIdtotal(dataCurrentFolderIdtotalAttr) : dataCurrentFolderIdtotalAttr;
	const isSameFolder = (dataCurrentParentIdtotal === dataDestinationFolderIdtotalAttr) ? 1 : 0;
	const maxElementsQuantity = setMaxElementsQuantity(dataDestinationFolderIdtotalAttr, elementToEditTypeAttr, isSameFolder);
	const inputNumberOrdernumber = document.getElementById('relocation-order-setnumber');
	if (inputNumberOrdernumber.value > maxElementsQuantity)	{
		inputNumberOrdernumber.value = maxElementsQuantity;
	}
	changeFolderToopen();
};
// 2.8. Установка переключателя 'в другую папку' - только для relocate
const checkedRadioOutfolder = () => {
	const elementDestinationFolder = document.getElementById('relocation-tree').querySelector('input');
	checkElement(elementDestinationFolder);
	showRelocationTree();
};
// 2.9. Закрытие рамки дерева для перемещений - только для relocate
const hideRelocationTree = () => {
	document.getElementById('relocation-tree').style.display = '';
};
// 2.10. Отображение рамки дерева для перемещений - только для relocate
const showRelocationTree = () => {
	// Получение editform-currentfolder-idtotal папки из которой выполняется операция перемещения
	const inputDestinationFolderIdValue = getInputValueFromId('editform-currentfolder-idtotal');
	// Получение editform-element-toedit-type для вычисления, перемещается Папка или Статья
	const inputElementtoeditTypeValue = getInputValueFromId('editform-element-toedit-type');

	// Установка/удаление disabled для элементов input[radio] дерева перемещений
	const relocationTree = document.getElementById('relocation-tree');
	const radiosOfRelocationFolders = relocationTree.querySelectorAll('input');
	for (let item of radiosOfRelocationFolders)	{
		item.removeAttribute('disabled');
	}
	for (let item of radiosOfRelocationFolders)	{
		const radioOfRelocationFolderValue = item.getAttribute('value');
		if (radioOfRelocationFolderValue === inputDestinationFolderIdValue)	{
			item.setAttribute('disabled', '');
			const branchUlOfChildren = item.parentNode.parentNode.nextElementSibling;
			if (branchUlOfChildren)	{
				if (inputElementtoeditTypeValue === 'folder' && branchUlOfChildren.tagName === 'UL')	{
					const branchLiOfChildren = branchUlOfChildren.querySelectorAll('li');
					for (let itemj of branchLiOfChildren)	{
						let k = itemj.querySelector('input');
						k.setAttribute('disabled', '');
					}
				}
			}
			//break;
		}
	}
	relocationTree.style.display = 'block';
	checkElement(radiosOfRelocationFolders[0]);
	changeFolderToopen();
};

export {setMaxElementsQuantity, changeFolderToopen, checkedRadioFirstOrdernumber, checkedRadioLastOrdernumber, checkedRadioOrderSetnumber, checkedRadioInfolder, checkedDestinationFolder, checkedRadioOutfolder, hideRelocationTree, showRelocationTree};
