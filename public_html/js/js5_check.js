// Скрипты, исполняемые JS5
(function()  {
	var styleEl = document.getElementById('js5-css');
	document.head.appendChild(styleEl);
	var styleSheet = styleEl.sheet;
	styleSheet.insertRule('.js5 {display: block;}', 0);
}());
