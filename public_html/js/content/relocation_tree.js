import {getInputValueFromId, setInputValueFromId, checkElement, getParentFolderIdtotal, setMaxElementsQuantity, changeFolderToopen} from './general.js';

/* 2. ОТОБРАЖЕНИЕ И ЗАКРЫТИЕ РАМКИ ДЕРЕВА ДЛЯ ПЕРЕМЕЩЕНИЯ И ДОБАВЛЕНИЯ - только для add и relocate */

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
	document.getElementById('relocation-tree').style.display = '';
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
		}
	}
	relocationTree.style.display = 'block';
	checkElement(radiosOfRelocationFolders[0]);
	changeFolderToopen();
};

// 2.8. Установка переключателя 'в другую папку' - только для relocate
const checkedRadioOutfolder = () => {
	const elementDestinationFolder = document.getElementById('relocation-tree').querySelector('input');
	checkElement(elementDestinationFolder);
	showRelocationTree();
};


// Установка обработчика события на отметку папки в дереве перемещений
if (document.getElementById('editform')) {
	const foldersHTMLCol = document.getElementsByName('relocation_destination_folder');
	const folders = Array.from(foldersHTMLCol);
	folders.forEach((item) => {
		item.addEventListener('click', () => {checkedDestinationFolder(item);});
	});
}

export {checkedRadioFirstOrdernumber, checkedRadioLastOrdernumber, checkedRadioOrderSetnumber, checkedRadioInfolder, checkedDestinationFolder, checkedRadioOutfolder, showRelocationTree};
