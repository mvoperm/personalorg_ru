<?php

/* Режим тестирования */

define('TEST_MODE', isset($_SESSION['test_mode']) ? 1 : 0); // Установка значения константы TEST_MODE

$test_mode_code = ''; // В случае активизации режима тестирования в следующем блоке происходит присвоение данной переменной строки кода, который будет внедрён на странице
if (USER_ID === '-1')	{
  $text_testmode_button = (TEST_MODE === 1) ? 'Обычный режим' : 'Тестовый режим';
  $test_mode_code = "
  <div class='header-menu-subitem'><!-- пункт раскрываемой части меню аккаунта -->
    <form id='test-mode-form' method='post' action='" . TOGGLE_TEST_MODE_FILEPATH . "' class='inline-form'>
      <button type='submit' name='toggle-test-mode' id='test-mode-button'>{$text_testmode_button}</button>
    </form>
  </div>
  <p class='header-menu-subitem test-mode'><a target='_blank' href='" . DOMAIN_URI . TEST_SCREEN_FILEPATH . "'>
    Свойства экрана [&#8663;]
  </a></p>
  ";
} // Код для режима тестирования

?>
