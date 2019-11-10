/* ОТОБРАЖЕНИЕ ПАПКИ В ОКНЕ ПРОСМОТРА СТАТЕЙ */
// 1. Отображение выбранной папки
const showFolderStyleAssignment = (dataFolderIdtotalAttr) => {
	const styleEl = document.getElementById('currentfolder-items');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	const treerule = `summary.folderstree-summary[data-folder-idtotal='${dataFolderIdtotalAttr}'] {font-weight: bold;}`;
	const itemsrule = `section.itemsfolder[data-folder-idtotal='${dataFolderIdtotalAttr}'] {display: block;}`;
	styleSheet.insertRule(treerule, 0);
	styleSheet.insertRule(itemsrule, 1);
};
// 2. Отображение начальной папки
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

export {showFolderStyleAssignment, startFolder};
