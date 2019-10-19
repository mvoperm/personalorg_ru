import {getInputValueFromId, setInputValueFromId, checkElementById, getParentFolderIdtotal, getFolderIdlocal, getFolderToopen} from './subs_content_aux.js';
import {setMaxElementsQuantity} from './subs_relocation_tree.js';
import {Editform} from './construct_Editform.js';

/* 3. ФОРМА КОРРЕКТИРОВКИ ДАННЫХ (отображение и закрытие) */

// 3.1. Установка начального положения переключателей и счётчика
const editformDisplayRules = (editType, elementToeditType) => {
	const classToDislay = (editType === 'add') ? 'edit' : editType;
	const styleEl = document.getElementById('editform-type');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	const displayTypeRule1 = `.editform-${classToDislay} {display: block;}`;
	styleSheet.insertRule(displayTypeRule1, 0);
	let i = 1;
	if (editType === 'add' || editType === 'relocate')	{
		const displayTypeRule2 = '.editform-relocate-add {display: block;}';
		styleSheet.insertRule(displayTypeRule2, i);
		i += 1;
	}
	if (classToDislay === 'edit' && elementToeditType === 'folder')	{
		const displayFolderRule3 = '#editform-item-par-text, #editform-item-par-uri {display: none;}';
		styleSheet.insertRule(displayFolderRule3, i);
	}
	if (classToDislay === 'delete')	{
		const displayFolderRule4 = '#editform {width: 20em; max-width: 92vw;}';
		styleSheet.insertRule(displayFolderRule4, i);
	}
};

// 3.2. Закрытие формы без изменений
const closeEditForm = () => {
	const editForm = document.getElementById('editform');
	editForm.close();
};

// 3.3. Отображение формы корректировки данных
const showForm = (objectToedit) => {

	// Получение основных переменных
	let objEditform = new Editform(
		objectToedit,
		objectToedit.getAttribute('data-edit-type'),
		getInputValueFromId('editform-content-name'),
		objectToedit.getAttribute('data-element-toedit-type'),
	);
	objEditform.menuToEdit.open = false; // Закрытие меню

	// Вставка значения editform-element-edit-type в соответствующее поле формы
	setInputValueFromId('editform-element-edit-type', objEditform.editType);
	// Вставка значения element-toedit-type в соответствующее поле формы
	setInputValueFromId('editform-element-toedit-type', objEditform.elementToeditType);

	// ПОЛУЧЕНИЕ ТРЕБУЕМЫХ ID
	// Получение значения data-folder-idtotal и вставка его в соответствующее поле формы
	setInputValueFromId('editform-currentfolder-idtotal', objEditform.currentFolderIdTotal);
	// Вычисление Id родителя и вставка его в соответствующее поле формы (в соответствии с логикой операции)
	setInputValueFromId('editform-currentparent-idtotal', objEditform.currentParentIdTotal);
	// Вычисление локального Id и вставка его в соответствующее поле формы (в соответствии с логикой операции)
	setInputValueFromId('editform-idlocal', objEditform.currentIdLocal);

	// Вычисление Id родителя и вставка его в соответствующее поле формы (в соответствии с логикой операции)
	setInputValueFromId('editform-parentfolder-idtotal', objEditform.destinationParentIdtotal);
	// Вычисление Id папки к отображению (для add и relocate - в начало папки, для relocate - в текущую папку) и вставка его в соответствующее поле формы
	document.getElementById('editform-folder-tooppen').value = objEditform.folderToopen;

	// ЗАПОЛНЕНИЕ ТЕКСТОВЫХ ПОЛЕЙ
	// Получение и вставка Заголовка формы (тип редактирования)
	const buttonInnerHTML = objectToedit.innerHTML;
	const dialogFormTitle = document.getElementById('editform-title');
	dialogFormTitle.innerHTML = buttonInnerHTML;
	// Заполнение полей Заголовка элемента
	setInputValueFromId('editform-element-title', objEditform.editformElementTitle);

	// Заполнение полей Адреса ссылки и Текста заметки/комментария
	setInputValueFromId('editform-item-uri', objEditform.editformItemUri);
	const textTagFormText = document.getElementById('editform-item-text');
	if (objEditform.textTag === 'textarea')	{
		textTagFormText.innerHTML = objEditform.editformItemText;
	} else	{
		textTagFormText.setAttribute('value', objEditform.editformItemText);
	}

	// Установка начальной папки и переключателей
	if (objEditform.editType === 'add')	{
		// Выбор текущей папки
		setMaxElementsQuantity(objEditform.currentFolderIdTotal, objEditform.elementToeditType, 0);
		// Выбор 1-й позиции для добавления
		checkElementById('editform-firstordernumber-radio');
	}
	if (objEditform.editType === 'relocate')	{
		// Выбор текущей папки для перемещения
		checkElementById('editform-infolder-radio');
		// Выбор 1-й позиции для перемещения
		checkElementById('editform-firstordernumber-radio');
	}

	// ОТОБРАЖЕНИЕ ФОРМЫ НА ЭКРАНЕ
	// Отображение полей и стилей формы в зависимости от типа редактирования
	editformDisplayRules(objEditform.editType, objEditform.elementToeditType);

	// Отображение Формы
	const dialogEditForm = document.getElementById('editform');
	if ('ontouchstart' in window)	{
		if (objEditform.editType !== 'delete')	{dialogEditForm.style.top = window.pageYOffset;} // Для сенсорных устройств. Для операций добавления и редактирования выскакивает клавиатура, для перемещения - само окно dialog большого размера. Для этих операций окно dialog отображается от самого верха страницы. Для операции удаления это не треубется.
		dialogEditForm.showModal();
	} else	{
		dialogEditForm.showModal();
		// Прокрутка окна вверх, если требуется, для Firefox
		const uAgent = navigator.userAgent;
		if (uAgent.includes('Firefox'))	{
			dialogEditForm.scrollIntoView({behavior: 'auto', block: 'center', inline: 'nearest'});
		}
	}

};

export {editformDisplayRules, closeEditForm, showForm};
