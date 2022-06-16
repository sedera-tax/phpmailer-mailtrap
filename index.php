<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// create a new mailing object
$mail = new PHPMailer();
// SMTP configuration
$mail->isSMTP();
$mail->Host = $_ENV['MAIL_HOST'];
$mail->SMTPAuth = true;
$mail->Port = $_ENV['MAIL_PORT'];
$mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];

$mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
$mail->addReplyTo($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
$mail->addAddress('sedera.aina@gmail.com', 'Sedera');   //Recipient
$mail->Subject = 'Test Email via Mailtrap SMTP using PHPMailer';

// Our HTML setup
$mail->isHTML(TRUE);
$mail->Body = "<h1>Hello John Doe, thank you for using SMTP in PHP.</h1><p>This is a test email I am sending using SMTP mail server with PHPMailer.</p>";
$mail->AltBody = 'Success';
// adding mailing attachment
try {
    $mail->addAttachment('./test.pdf', 'test.pdf');
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo 'Exception: ' . $e->getMessage();
    die();
}
// send the thank you messange
try {
    if ($mail->send()) {
        echo 'Your message has been sent successfully.';
    } else {
        echo 'Your message could not be develired, try again later';
        echo 'Error: ' . $mail->ErrorInfo;
    }
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo 'Exception: ' . $e->getMessage();
    die();
}