import {showForm} from '../subs_editform.js';

/* Функции, связанные с выбором папки для отображения в блоке #items */

// Отображение выбранной папки
const showFolderStyleAssignment = (dataFolderIdtotalAttr) => {
	const styleEl = document.getElementById('currentfolder-items');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	const treerule = `summary.folderstree-summary[data-folder-idtotal='${dataFolderIdtotalAttr}'] {font-weight: bold;}`;
	const itemsrule = `section.itemsfolder[data-folder-idtotal='${dataFolderIdtotalAttr}'] {display: block;}`;
	styleSheet.insertRule(treerule, 0);
	styleSheet.insertRule(itemsrule, 1);
};
// Отображение начальной папки
const startFolder = (dataFolderIdtotalAttr) => {
	if (dataFolderIdtotalAttr !== '0')	{
		const folders = dataFolderIdtotalAttr.split('-');
		let currentFoldertreeDetails = document.getElementById('folderstree');
		let currentDataFolderId = folders[0];
		let currentFoldertreeSummary = currentFoldertreeDetails.querySelector(`summary[data-folder-idtotal='${currentDataFolderId}']`);
		currentFoldertreeDetails = currentFoldertreeSummary.parentNode;
		currentFoldertreeDetails.open = true;
		const foldersLength = folders.length;
		for (let i = 1; i < foldersLength; i++)	{
			currentDataFolderId += `-${folders[i]}`;
			currentFoldertreeSummary = currentFoldertreeDetails.querySelector(`summary[data-folder-idtotal='${currentDataFolderId}']`);
			currentFoldertreeDetails = currentFoldertreeSummary.parentNode;
			currentFoldertreeDetails.open = true;
		}
	}
};

/* УСТАНОВКА ОБРАБОТЧИКОВ СОБЫТИЙ */
// Запуск стартовой папки
{
	const body = document.getElementsByTagName('body')[0];
	const start = body.getAttribute('data-startfolder');
	startFolder(start);
	showFolderStyleAssignment(start);
}
// Установка обработчика события отображения папки по щелчку
{
	const foldersHTMLCol = document.getElementsByClassName('folderstree-summary');
	const folders = Array.from(foldersHTMLCol);
	folders.forEach((item) => {
		let start = item.getAttribute('data-folder-idtotal');
		item.addEventListener('click', () => {showFolderStyleAssignment(start);});
	});
}
/* Только для страниц контента Пользователя */
// Установка обработчика события отображения формы по щелчку
if (document.getElementById('editform')) {
  const buttonsHTMLCol = document.getElementsByClassName('editmenu-subdetails-button');
  const buttons = Array.from(buttonsHTMLCol);
  buttons.forEach((item) => {
  	item.addEventListener('click', () => {showForm(item);});
  });
}
