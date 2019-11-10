<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php-scripts/files_paths.php'); // Файл с константами путей к требуемым файлам php-скриптов

require_once(DOMAIN_ROOT . PW_FILEPATH);

define('SMTP_HOST', 'smtp.beget.com');
define('SMTP_PORT', 2525);
define('HEADERS_MIME', "MIME-Version: 1.0\r\n");
define('HEADERS_CONTEMT_TYPE', "Content-type: text/html; charset=utf-8\r\n");
define('HEADERS_REPLY_ADMIN', "Reply-To: " . SMTP_ADMIN_LOGIN . "\r\n");
define('HEADERS_FROM_ADMIN', "From: " . SMTP_ADMIN_NAME . " <" . SMTP_ADMIN_LOGIN . ">\r\n");
define('HEADERS_ADMIN', HEADERS_MIME . HEADERS_CONTEMT_TYPE . HEADERS_FROM_ADMIN . HEADERS_REPLY_ADMIN);
define('HEADERS_FROM_ROBOT', "From: " . SMTP_ROBOT_NAME . " <" . SMTP_ROBOT_LOGIN . ">\r\n");
define('HEADERS_ROBOT', HEADERS_MIME . HEADERS_CONTEMT_TYPE . HEADERS_FROM_ROBOT . HEADERS_REPLY_ADMIN);

class SendMailSmtpClass {
// https://vk-book.ru/otpravka-pisem-cherez-smtp-s-avtorizaciej-na-php/

/**
* SendMailSmtpClass
*
* Класс для отправки писем через SMTP с авторизацией
* Может работать через SSL протокол
* Тестировалось на почтовых серверах yandex.ru, mail.ru и gmail.com
*
* @author Ipatov Evgeniy <admin@ipatov-soft.ru>
* @version 1.0
* Модифицирован m.oskotskiy@mail.ru 01.05.219
*/
    /**
    *
    * @var string $smtp_username - логин
    * @var string $smtp_password - пароль
    * @var string $smtp_host - хост
    * @var string $smtp_from - от кого
    * @var integer $smtp_port - порт
    * @var string $smtp_charset - кодировка
    *
    */
    public $smtp_username;
    public $smtp_password;
    public $smtp_host;
    public $smtp_from;
    public $smtp_port;
    public $smtp_charset;

    public function __construct($smtp_username, $smtp_password, $smtp_host, $smtp_from, $smtp_port, $smtp_charset = "utf-8") {
        $this -> smtp_username = $smtp_username;
        $this -> smtp_password = $smtp_password;
        $this -> smtp_host = $smtp_host;
        $this -> smtp_from = $smtp_from;
        $this -> smtp_port = $smtp_port;
        $this -> smtp_charset = $smtp_charset;
    }

    /**
    * Отправка письма
    *
    * @param string $mailTo - получатель письма
    * @param string $subject - тема письма
    * @param string $message - тело письма
    * @param string $headers - заголовки письма
    *
    * @return bool|string В случаи отправки вернет true, иначе текст ошибки    *
    */
    function send($mailTo, $subject, $message, $headers) {
        $contentMail = "Date: " . date("D, d M Y H:i:s") . " UT\r\n";
        $contentMail .= "Subject: =?" . $this -> smtp_charset . "?B?"  . base64_encode($subject) . "=?=\r\n";
        $contentMail .= $headers . "\r\n";
		//$message = chunk_split(base64_encode($message));
        $contentMail .= $message . "\r\n";
		$mailTo = ltrim($mailTo, '<');
		$mailTo = rtrim($mailTo, '>');

        try {
            $answer = 'Ответ сервера:<br />';

      			$request = array( // + "\r\n"
      				"",
      				"EHLO " . $_SERVER['SERVER_NAME'],
      				"AUTH LOGIN",
      				base64_encode($this -> smtp_username),
      				base64_encode($this -> smtp_password),
      				"MAIL FROM: <". $this -> smtp_username . ">",
      				"RCPT TO: <" . $mailTo . ">",
      				"DATA",
      				$contentMail . "\r\n."
      			);

      			$responce_code = array(220, 250, 334, 334, 235, 250, 250, 354, 250);

      			$error = array( // + " " +  ". $responce"
      				'Connection error',
      				'Error of command sending: EHLO',
      				'Autorization error AUTH LOGIN',
      				'Autorization error USERNAME',
      				'Autorization error PASSWORD',
      				'Error of command sending: MAIL FROM',
      				'Error of command sending: RCPT TO',
      				'Error of command sending: DATA',
      				"E-mail didn't sent"
      			);


      			$length = count($request);
      			for ($i = 0; $i < $length; $i++)	{
      				switch ($i)	{
      					case 0:
      						if(!$socket = @fsockopen($this -> smtp_host, $this -> smtp_port, $errorNumber, $errorDescription, 30))	{
      							throw new Exception($errorNumber . '.' . $errorDescription);
      						}
      						break;
      					default:
      						fputs($socket, $request[$i] . "\r\n");
      						break;
      				}
      				$responce = $this -> _parseServer($socket, $responce_code[$i]);
      				if (!$responce) {
      					fclose($socket);
      					throw new Exception($error[$i] . ' ' . $responce);
      				}
      				$answer .= $responce . '<br />';
      			}

                  fputs($socket, "QUIT\r\n");
                  fclose($socket);
      			$answer = '1_' . $answer;

        } catch (Exception $e) {
            $answer = $e -> getMessage();
			$answer = '0_' . $answer;
        }

		return $answer;
    }

    private function _parseServer($socket, $code) {
		while (@substr($responseServer, 3, 1) != ' ') {
			if (!($responseServer = fgets($socket, 256))) {
                return false;
            }
        }
        if (!(substr($responseServer, 0, 3) == $code)) {
			return false;
        }
        return $responseServer;
    }
}


/* БЛОК ОТПРАВКИ ПОЧТЫ */

function construct_mail($email, $id, $pw, $purpose, $addition = [])	{
	define('SUBJ_BEGINNING', 'PersonalOrg.ru: ');
	define('GREETING', "Добрый день.<br><br>");
	define('APOLOGY', "<br>Если Вы не регистрировались на данном ресурсе, значит кто-то ввёл Ваш адрес по ошибке. В этом случае, Вам ничего делать не надо и просто удалите это письмо. Приносим свои извинения за доставленные неудобства.");
	define('SIGNATURE', "<br><br>С уважением, администратор PersonalOrg.ru<br>" . SMTP_ADMIN_LOGIN);

	switch ($purpose)	{
		case 'signin':
			$subj = SUBJ_BEGINNING . 'регистрация в системе и установка пароля';
			$text = GREETING . "----------<br>Ваш адрес был указан при регистрации на сайте personalorg.ru." . APOLOGY . "<br>----------<br><br>Если письмо пришло правильно, то<br><br>Ваш ID: " . $id . "<br>Вы можете использовать для входа в систему ID или данный адрес электронной почты.<br><br>Ваш пароль: " . $pw . "<br>Вы можете сменить данный пароль в любое время на странице настроек." . SIGNATURE;
			$headers = HEADERS_ROBOT;
			break;
		case 'pw_recovery':
			$subj = SUBJ_BEGINNING . 'восстановление пароля';
			$text = GREETING . "Ваш ID: " . $id . "<br>Ваш новый пароль: " . $pw . SIGNATURE;
			$headers = HEADERS_ROBOT;
			break;
		case 'email_change':
			$subj = SUBJ_BEGINNING . 'изменение электронной почты пользователя';
			$text = GREETING . "----------<br>Ваш адрес был указан при изменении электронной почты пользователя на сайте personalorg.ru." . APOLOGY . "<br>----------<br><br>Если письмо пришло правильно, то<br><br>Для подтверждения нового электронного адреса необходимо ввести код: " . $pw . SIGNATURE;
			$headers = HEADERS_ROBOT;
			break;
		case 'pw_change':
			$subj = SUBJ_BEGINNING . 'изменение пароля';
			$text = GREETING . "Ваш пароль успешно изменён.<br><br>Ваш ID: " . $id . "<br><br>Ваш новый пароль: " . $pw . SIGNATURE;
			$headers = HEADERS_ROBOT;
			break;
		case 'account_deletion':
			$subj = SUBJ_BEGINNING . 'удаление аккаунта';
			$text = GREETING . "----------<br>С Вашего адреса был отправлен запрос на удаление аккаунта пользователя на сайте personalorg.ru. Если Вы не делали данный запрос или не регистрировались на данном ресурсе, значит произошла системная ошибка. Вам ничего делать не надо и просто удалите это письмо. Аккаунт удалён не будет. Приносим свои извинения за доставленные неудобства.<br>----------<br><br>Если письмо пришло правильно, то<br><br>Для подтверждения удаления аккаунта необходимо ввести код: " . $pw . SIGNATURE;
			$headers = HEADERS_ROBOT;
			break;
		case 'confirm_account_deletion':
			$subj = SUBJ_BEGINNING . 'подтверждение удаления аккаунта';
			$text = "----------<br>" . GREETING . "<br>Данное письмо должно прийти автоматически по адресу admin@personalorg.ru. Если оно пришло по другому адресу, значит произошла системная ошибка. Вам ничего делать не надо и просто удалите это письмо. Приносим свои извинения за доставленные неудобства." . SIGNATURE . "<br>----------<br><br>Запрос на удаление аккаунта пользователя с <br>ID = " . $id . "<br>email = " . $email;
			$headers = HEADERS_ROBOT;
			$email = 'admin@personalorg.ru';
			break;
		case 'test':
			$subj = SUBJ_BEGINNING . 'тестирование (для ' . $email . ')';
			$text = GREETING . "----------<br>Идёт тестирования нового ресурса PersonalOrg.ru.<br>Письмо должно прийти по адресу " . $email . "<br>Если письмо пришло по другому адресу, приносим свои извинения за доставленные неудобства. Просим просто удалить это письмо.<br>----------" . SIGNATURE;
			$headers = HEADERS_ROBOT;
			break;
		case 'system_error':

			break;
		default:
			// ? - Описать действия по умолчанию
			break;
	}

	$mailSMTP = new SendMailSmtpClass(SMTP_ROBOT_LOGIN, SMTP_ROBOT_PW, SMTP_HOST, SMTP_ROBOT_NAME, SMTP_PORT); // создаем экземпляр класса
	// $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя', 'порт');

	$result = $mailSMTP -> send($email, $subj, $text, $headers);
	return $result; // Возвращает сообщения сервера с добавленной к началу '1_' или сообщение об ошибке с добавленной к началу '0_'. Если подробности не нужны, то нужно взять только первый символ (substr($result, 0, 1) == 1|0)
}

?>
