// Скрипты, исполняемые JS5
(function()  {
	var testEl = document.getElementById('test-js6module');
	if (testEl.innerHTML != '1')	{
		var styleEl = document.getElementById('js5-css');
		document.head.appendChild(styleEl);
		var styleSheet = styleEl.sheet;
		styleSheet.insertRule('.js5 {display: block;}', 0);
	}
}());