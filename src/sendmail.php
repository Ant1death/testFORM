<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    $mail->setFrom('', 'Отправитель'); // Отправитель

    $mail->addAddress(''); // Получатель

    $mail->Subject = 'Тест';

    if(trim(!empty($_POST['region']))){
        $body.='<p?><strong>Регион:</strong>? '.$_POST['region']. '</p>';
    }
    if(trim(!empty($_POST['region']))){
        $body.='<p?><strong>Город:</strong>? '.$_POST['city']. '</p>';
    }
    if(trim(!empty($_POST['region']))){
        $body.='<p?><strong>Населенный пункт:</strong>? '.$_POST['settlement']. '</p>';
    }
    if(trim(!empty($_POST['region']))){
        $body.='<p?><strong>Улица:</strong>? '.$_POST['street']. '</p>';
    }
    if(trim(!empty($_POST['region']))){
        $body.='<p?><strong>Дом:</strong>? '.$_POST['house']. '</p>';
    }

    $mail->Body = $body;

    if(!$mail->send()) {
        $message = 'Ошибка';
    } else {
        $message = 'Данные отправлены!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response)
?>