/* Конструктор Editform */
import {getParentFolderIdtotal, getFolderIdlocal, getFolderToopen} from './subs_content_aux.js';

function Editform (objectToedit, editType, contentName, elementToeditType) {
  this.objectToedit = objectToedit;
  this.editType = editType;
  this.contentName = contentName;
  this.elementToeditType = elementToeditType;

  // Вычисляемые свойства
  this.menuToEdit = objectToedit.parentNode.parentNode.parentNode; // Переход от кнопки к Меню
  this.elementToEdit = (elementToeditType === 'folder' || editType === 'add') ? this.menuToEdit.parentNode.parentNode.parentNode : this.menuToEdit.parentNode.parentNode; // Переход от кнопки к Папке / Статье
  this.currentFolderIdTotal = this.elementToEdit.getAttribute('data-folder-idtotal');
  this.currentParentIdTotal = (elementToeditType === 'folder') ? getParentFolderIdtotal(this.currentFolderIdTotal) : this.currentFolderIdTotal;
  this.currentIdLocal = (editType === 'add') ? '' :
    (elementToeditType === 'folder') ? getFolderIdlocal(this.currentFolderIdTotal) : this.elementToEdit.getAttribute('data-idlocal');
  this.destinationParentIdtotal = (elementToeditType === 'folder' && (editType === 'delete' || editType === 'relocate')) ?
    getParentFolderIdtotal(this.currentFolderIdTotal) : this.currentFolderIdTotal;
	if (elementToeditType === 'folder' && (editType === 'add' || editType === 'relocate'))	{
		this.folderToopen = getFolderToopen(this.destinationParentIdtotal, '1');
	} else	{
		this.folderToopen = this.destinationParentIdtotal;
	}

	// Заполнение полей Заголовка элемента
	if (editType == 'edit')	{
		const articleTitleTag = (elementToeditType === 'folder') ? 'h2' : 'h4';
		const articleTitle = this.elementToEdit.querySelector(articleTitleTag);
		this.editformElementTitle = articleTitle.textContent;
	} else {
    this.editformElementTitle = '';
  }

	// Заполнение полей Адреса ссылки и Текста заметки/комментария
	if (editType === 'edit' && elementToeditType === 'item')	{
		const articleItem = this.elementToEdit.querySelectorAll('p:not(.editmenu-subdetails-p)');
		if (articleItem.length > 0)	{
			const linkContent = articleItem[0].getElementsByTagName('a');
      let i;
      if (linkContent.length === 1)	{
        this.editformItemUri = linkContent[0].textContent;
				i = 1;
			} else {
        this.editformItemUri = '';
        i = 0;
      }

			let articleText = articleItem[i].textContent;
			const articleItemLength = articleItem.length;
			for (i++; i < articleItemLength; i++)	{
				articleText += ('\n' + articleItem[i].textContent);
			}
      this.editformItemText = articleText;
		}
	} else {
    this.editformItemUri = '';
    this.editformItemText = '';
  }
  this.textTag = (contentName === 'notes') ? 'textarea' : 'input';
}

export {Editform};
