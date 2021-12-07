<?php 

require_once __DIR__ . '\..\app\phpMailerFiles\Exception.php';
require_once __DIR__ . '\..\app\phpMailerFiles\PHPMailer.php';
require_once __DIR__ . '\..\app\phpMailerFiles\SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class email{

public static function enviarCorreo($sendTo, $asunto, $mensaje)
{

    try{

        $mail = new PHPMailer(true);

       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'alexdaw1920@gmail.com';                     // SMTP username
        $mail->Password   = '149755locos';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587; 

        $mail->setFrom('alexdaw1920@gmail.com', 'APAU');
        $mail->addAddress($sendTo);
        $mail->isHTML(true);  
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $asunto;
        $mail->Body    =$mensaje;

        $mail->send();


    }catch(Exception $e){
        error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
    }
}



}

?>