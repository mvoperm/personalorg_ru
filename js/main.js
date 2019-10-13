/* ИМПОРТ МОДУЛЕЙ */
import {startFolder, showFolderStyleAssignment} from './subs_content_showfolder.js';
import {toggleFolderstree} from './subs_content_aux.js';
import {changeFolderToopen, checkedRadioFirstOrdernumber, checkedRadioLastOrdernumber, checkedRadioOrderSetnumber, checkedRadioInfolder, checkedDestinationFolder, checkedRadioOutfolder} from './subs_relocation_tree.js';
import {showForm, closeEditForm} from './subs_editform.js';


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

/* Скрипты только для страниц контента */
if (document.getElementById('editform'))	{
// Установка обработчика события на отметку папки в дереве перемещений
{
	const foldersHTMLCol = document.getElementsByName('relocation_destination_folder');
	const folders = Array.from(foldersHTMLCol);
	folders.forEach((item) => {
		item.addEventListener('click', () => {checkedDestinationFolder(item);});
	});
}
// Установка обработчика события на отметку папки предка в ветке выбранной папки
{
	const branchHTMLCol = document.getElementsByClassName('itemsfolder-branch-ancestor');
	const branch = Array.from(branchHTMLCol);
	branch.forEach((item) => {
		const start = item.getAttribute('data-startfolder');
		item.addEventListener('click', () => {startFolder(start); showFolderStyleAssignment(start);});
	});
}
// Установка обработчика события отображения формы по щелчку
{
	const buttonsHTMLCol = document.getElementsByClassName('editmenu-button');
	const buttons = Array.from(buttonsHTMLCol);
	buttons.forEach((item) => {
		item.addEventListener('click', () => {showForm(item);});
	});
}
// Установка обработчика события на закрытия формы без изменений
{
	const cancel = document.getElementById('cancel');
	cancel.addEventListener('click', closeEditForm);
}
// Установка обработчика событий на переключатели и счётчик формы
{
	const inputInFolder = document.getElementById('editform-infolder-radio');
	inputInFolder.addEventListener('click', checkedRadioInfolder);
	const inputOutFolder = document.getElementById('editform-outfolder-radio');
	inputOutFolder.addEventListener('click', checkedRadioOutfolder);
	const inputFirst = document.getElementById('editform-firstordernumber-radio');
	inputFirst.addEventListener('click', checkedRadioFirstOrdernumber);
	const inputLast = document.getElementById('editform-lastordernumber-radio');
	inputLast.addEventListener('click', checkedRadioLastOrdernumber);
	const inputSet = document.getElementById('editform-setordernumber-radio');
	inputSet.addEventListener('click', checkedRadioOrderSetnumber);
	const inputNumber = document.getElementById('relocation-order-setnumber');
	inputNumber.addEventListener('change', changeFolderToopen);
}
}