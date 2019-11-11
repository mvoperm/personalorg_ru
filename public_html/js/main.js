/* ИМПОРТ МОДУЛЕЙ */
import {changeFolderToopen, checkedRadioFirstOrdernumber, checkedRadioLastOrdernumber, checkedRadioOrderSetnumber, checkedRadioInfolder, checkedDestinationFolder, checkedRadioOutfolder} from './subs_relocation_tree.js';
import {showForm, closeEditForm} from './subs_editform.js';

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
// Установка обработчика события отображения формы по щелчку
{
	const buttonsHTMLCol = document.getElementsByClassName('editmenu-subdetails-button');
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
	inputNumber.addEventListener('focus', () => {inputSet.checked = true;});
}
}
