<?php
/*
Testowano na Apache'u na systemie Windows 10
*/

require_once "C:/Users/Khepri/vendor/autoload.php";
require_once "C:/Users/Khepri/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "C:/Users/Khepri/vendor/phpmailer/phpmailer/src/SMTP.php";

$mail = new PHPMailer\PHPMailer\PHPMailer();

/*
Testowane na Gmail,
Google wymusza zmiany w ustawieniach tak,
aby "mniej bezpieczne aplikacje" mogly uzywac konta Gmail. 
*/
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "moj_mail@gmail.com";
$mail->Password = "jakieshaslo";
$mail->SetFrom("moj_mail@gmail.com");
$mail->Subject = "Mail z localhost!";
$mail->Body = "Hej";
$rcpt = $_GET["name"];
# $mail->AddAddress("jakismail@domena.pl");
$mail->AddAddress($rcpt);

$mail->smtpConnect([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);

if(!$mail->send()) 
{
    echo "Blad modulu: " . $mail->ErrorInfo;
} 
else 
{
    echo "Wiadomosc wyslano";
}
$mail->smtpClose();
