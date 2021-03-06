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
// Отображение/скрытие дерева папок
const toggleFolderstree = () => {
	const mainEl = document.getElementsByTagName('main')[0];
	mainEl.classList.toggle('reverse-display-mode');
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
// Установка обработчика событий на отображение/скрытие дерева папок
{
	const buttonsToggleFolderstree = document.getElementsByClassName('toggle-folderstree-button');
	for (let item of buttonsToggleFolderstree)	{
		item.addEventListener('click', toggleFolderstree);
	}
}

/* Только для страниц контента Пользователя */
// Установка обработчика события на отметку папки предка в ветке выбранной папки
if (document.getElementById('editform')) {
	const branchHTMLCol = document.getElementsByClassName('itemsfolder-branch-ancestor');
	const branch = Array.from(branchHTMLCol);
	branch.forEach((item) => {
		const start = item.getAttribute('data-startfolder');
		item.addEventListener('click', () => {startFolder(start); showFolderStyleAssignment(start);});
	});
}
