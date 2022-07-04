<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

if($_POST){

require __DIR__ . '/vendor/autoload.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subjects = $_POST['subjects'];
$message = $_POST['message'];

// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Тема:</b> $subjects<br><br>
<b>Сообщение:</b><br>$message
";

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

// Настройки
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$mail->Username = 'abreg2800@gmail.com'; // логин от вашей почты
$mail->Password = 'Zhora2000'; // пароль от почтового ящика
$mail->SMTPSecure = 'ssl';
$mail->Port = '465';
$mail->setFrom = 'abreg2800@gmail.com'; // адрес почты, с которой идет отправка
$mail->FromName = 'Админ'; // имя отправителя
$mail->addAddress('abreg2800@gmail.com');

$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);

// Письмо
$mail->isHTML(true);
$mail->Body = "Имя: {$_POST['name']}<br> E-mail: {$_POST['email']}<br> Тема сообщения: {$_POST['subjects']}<br> Сообщение: " . nl2br($_POST['message']);
$mail->AltBody = "Имя: {$_POST['name']}\r\n E-mail: {$_POST['email']}\r\n Тема сообщения: {$_POST['subjects']}\r\n Сообщение: {$_POST['message']}";
$mail->SMTPDebug = 0;

  if( $mail->send() ){
    $answer = '1';
  }else{
    $answer = '0';
    echo 'Письмо не может быть отправлено. ';
    echo 'Ошибка: ' . $mail->ErrorInfo;
  }
  die( $answer );
}
?>