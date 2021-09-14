<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('primetimedvp@gmail.com', 'Клиент');
	//Кому отправить
	$mail->addAddress('primetimedvp@gmail.com');
	//Тема письма
	$mail->Subject = 'Заявка';

	if ($_POST['option'] == "visit") {
		$option = "Создание сайта визитки";
	} else if ($_POST['option'] == "landing") {
		$option = "Landing Page";
	} else if ($_POST['option'] == "magazine") {
		$option = "Создание интернет-магазина";
	} else if ($_POST['option'] == "hotel") {
		$option = "Сайт для отеля";
	} else if ($_POST['option'] == "smm") {
		$option = "SMM-продвижение";
	} else if ($_POST['option'] == "seo") {
		$option = "SEO-продвижение";
	} else if ($_POST['option'] == "app") {
		$option = "Создание Android/IOS приложений";
	}

	//Тело письма
	$body = '<h1>Заявка от клиента</h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['phone']))){
		$body.='<p><strong>Телефон:</strong> '.$_POST['phone'].'</p>';
	}
	if(trim(!empty($_POST['option']))){
		$body.='<p><strong>Услуга:</strong> '.$option.'</p>';
	}
	
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
	}
	
	//Прикрепить файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//путь загрузки файла
		$filePath = __DIR__ . "/files/" . $_FILES['image']['name']; 
		//грузим файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong>';
			$mail->addAttachment($fileAttach);
		}
	}

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>