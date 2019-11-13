import {changeFolderToopen} from './general.js';
import {checkedRadioFirstOrdernumber, checkedRadioLastOrdernumber, checkedRadioOrderSetnumber, checkedRadioInfolder, checkedRadioOutfolder} from './relocation_tree.js';

/* ФОРМА РЕДАКТИРОВАНИЯ КОНТЕНТА - установка обработчиков событий на элементы */

// Установка обработчика событий на переключатели и счётчик формы
if (document.getElementById('editform')) {
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
