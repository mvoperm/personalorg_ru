// Скрипты, исполняемые JS5
(function()  {
	if (document.getElementById('js6-check').innerHTML !== '1') {
		var styleEl = document.getElementById('js5-css');
		document.head.appendChild(styleEl);
		var styleSheet = styleEl.sheet;
		styleSheet.insertRule('.js5 {display: block;}', 0);
	}
}());
