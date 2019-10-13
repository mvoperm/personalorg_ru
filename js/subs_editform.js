import {getInputValueFromId, setInputValueFromId, checkElementById, getParentFolderIdtotal, getFolderIdlocal, getFolderToopen} from './subs_content_aux.js';
import {setMaxElementsQuantity} from './subs_relocation_tree.js';

/* 3. ФОРМА КОРРЕКТИРОВКИ ДАННЫХ (отображение и закрытие) */

// 3.1. Установка начального положения переключателей и счётчика
const editformDisplayRules = (dataEditTypeAttr, elementToEditTypeAttr) => {
	const classToDislay = (dataEditTypeAttr === 'add') ? 'edit' : dataEditTypeAttr;
	const styleEl = document.getElementById('editform-type');
	document.head.appendChild(styleEl);
	const styleSheet = styleEl.sheet;
	const displayTypeRule1 = `.editform-${classToDislay} {display: block;}`;
	styleSheet.insertRule(displayTypeRule1, 0);
	let i = 1;
	if (dataEditTypeAttr === 'add' || dataEditTypeAttr === 'relocate')	{
		const displayTypeRule2 = '.editform-relocate-add {display: block;}';
		styleSheet.insertRule(displayTypeRule2, i);
		i += 1;
	}
	if (classToDislay === 'edit' && elementToEditTypeAttr === 'folder')	{
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
const showForm = (objectEditType) => {
	
	// Получение основных переменных
	const dialogEditForm = document.getElementById('editform');
	const elementToEditTypeAttr = objectEditType.getAttribute('data-element-toedit-type'); // Определение типа Элемента к редактированию (Папка или Статья)
	const dataEditTypeAttr = objectEditType.getAttribute('data-edit-type'); // Тип редактирования
	const menuToEdit = objectEditType.parentNode.parentNode.parentNode; // Переход от кнопки к Меню
	menuToEdit.open = false; // Закрытие меню
	//
	
	// ЗАПОЛНЕНИЕ ПОЛЕЙ meta (кроме максимального значения счётчика)
	// Получение значения content-name для определения тега Текста (textarea или input)
	const contentName = getInputValueFromId('editform-content-name');
	const textTag = (contentName == 'notes') ? 'textarea' : 'input';
	
	// Вставка значения element-toedit-type в соответствующее поле формы
	setInputValueFromId('editform-element-toedit-type', elementToEditTypeAttr);
	// Вставка значения editform-element-edit-type в соответствующее поле формы
	setInputValueFromId('editform-element-edit-type', dataEditTypeAttr);
	
	// ПОЛУЧЕНИЕ ТРЕБУЕМЫХ ID
	// Получение значения data-folder-idtotal и вставка его в соответствующее поле формы
	const elementToEdit = (elementToEditTypeAttr === 'folder' || dataEditTypeAttr === 'add') ? menuToEdit.parentNode.parentNode.parentNode : menuToEdit.parentNode.parentNode; // Переход от кнопки к Папке / Статье
	const dataFolderIdtotalAttr = elementToEdit.getAttribute('data-folder-idtotal');
	setInputValueFromId('editform-currentfolder-idtotal', dataFolderIdtotalAttr);
	// Вычисление Id родителя и вставка его в соответствующее поле формы (в соответствии с логикой операции)
	const dataParentCurrentIdtotal = (elementToEditTypeAttr === 'folder') ? getParentFolderIdtotal(dataFolderIdtotalAttr) : dataFolderIdtotalAttr;
	setInputValueFromId('editform-currentparent-idtotal', dataParentCurrentIdtotal);
	// Вычисление локального Id и вставка его в соответствующее поле формы (в соответствии с логикой операции)
	if (dataEditTypeAttr !== 'add')	{
		const dataElementIdlocalAttr = (elementToEditTypeAttr === 'folder') ? getFolderIdlocal(dataFolderIdtotalAttr) : elementToEdit.getAttribute('data-idlocal');
		setInputValueFromId('editform-idlocal', dataElementIdlocalAttr);
	}
	
	// Вычисление Id родителя и вставка его в соответствующее поле формы (в соответствии с логикой операции)
	const dataParentFolderIdtotal = (elementToEditTypeAttr === 'folder' && (dataEditTypeAttr === 'delete' || dataEditTypeAttr === 'relocate')) ? getParentFolderIdtotal(dataFolderIdtotalAttr) : dataFolderIdtotalAttr;
	setInputValueFromId('editform-parentfolder-idtotal', dataParentFolderIdtotal);
	// Вычисление Id папки к отображению (для add и relocate - в начало папки, для relocate - в текущую папку) и вставка его в соответствующее поле формы
	if (elementToEditTypeAttr === 'folder' && (dataEditTypeAttr === 'add' || dataEditTypeAttr === 'relocate'))	{
		document.getElementById('editform-folder-tooppen').value = getFolderToopen(dataParentFolderIdtotal, '1');
		console.log('Вычисление Id папки к отображению - subs_editform');
	} else	{
		document.getElementById('editform-folder-tooppen').value = dataParentFolderIdtotal;
	}
	
	// ЗАПОЛНЕНИЕ ТЕКСТОВЫХ ПОЛЕЙ
	// Получение и вставка Заголовка формы (тип редактирования)
	const buttonInnerHTML = objectEditType.innerHTML;
	const dialogFormTitle = document.getElementById('editform-title');
	dialogFormTitle.innerHTML = buttonInnerHTML;
	// Заполнение полей Заголовка элемента
	if(dataEditTypeAttr == 'edit')	{
		const articleTitleTag = (elementToEditTypeAttr === 'folder') ? 'h2' : 'h4';
		const articleTitle = elementToEdit.querySelector(articleTitleTag);
		const articleTitleText = articleTitle.textContent;
		setInputValueFromId('editform-element-title', articleTitleText);
	}
	// Заполнение полей Адреса ссылки и Текста заметки/комментария
	if(dataEditTypeAttr === 'edit' && elementToEditTypeAttr === 'item')	{
		const articleItem = elementToEdit.querySelectorAll('p:not(.command-button)');
		if (articleItem.length > 0)	{
			const linkContent = articleItem[0].getElementsByTagName('a');
			let i = 0;
			if (linkContent.length === 1)	{
				setInputValueFromId('editform-item-uri', linkContent[0].textContent);
				i = 1;
			}
			
			let articleText = articleItem[i].textContent;
			const articleItemLength = articleItem.length;
			for (i++; i < articleItemLength; i++)	{
				articleText += ('\n' + articleItem[i].textContent);
			}
			const textTagFormText = document.getElementById('editform-item-text');
			
			if (textTag === 'textarea')	{
				textTagFormText.innerHTML = articleText;
			} else	{
				textTagFormText.setAttribute('value', articleText);
			}
		}
	}
	//
	
	// Установка начальной папки и переключателей
	if (dataEditTypeAttr === 'add')	{
		// Выбор текущей папки
		setMaxElementsQuantity(dataFolderIdtotalAttr, elementToEditTypeAttr, 0);
		
		// Выбор 1-й позиции для добавления
		checkElementById('editform-firstordernumber-radio');
	}
	
	if (dataEditTypeAttr === 'relocate')	{
		// Выбор текущей папки для перемещения
		checkElementById('editform-infolder-radio');
		// Выбор 1-й позиции для перемещения
		checkElementById('editform-firstordernumber-radio');
	}
	
	// ОТОБРАЖЕНИЕ ФОРМЫ НА ЭКРАНЕ
	// Отображение полей и стилей формы в зависимости от типа редактирования	
	editformDisplayRules(dataEditTypeAttr, elementToEditTypeAttr);
	
	// Отображение Формы
	if ('ontouchstart' in window)	{
		if (dataEditTypeAttr !== 'delete')	{dialogEditForm.style.top = window.pageYOffset;} // Для сенсорных устройств. Для операций добавления и редактирования выскакивает клавиатура, для перемещения - само окно dialog большого размера. Для этих операций окно dialog отображается от самого верха страницы. Для операции удаления это не треубется.
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