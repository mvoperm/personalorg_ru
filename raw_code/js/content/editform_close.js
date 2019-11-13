/* ФОРМА РЕДАКТИРОВАНИЯ КОНТЕНТА - закрытие формы */

// Функция закрытия формы без изменений
const closeEditForm = () => {
	const editForm = document.getElementById('editform');
	editForm.close();
};

// Установка обработчика события на закрытия формы без изменений
if (document.getElementById('editform')) {
	const cancel = document.getElementById('cancel');
	cancel.addEventListener('click', closeEditForm);
}
