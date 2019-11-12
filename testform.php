<?php

//echo phpinfo();
//die();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require($_SERVER['DOCUMENT_ROOT'].'/PHPMailer-master/PHPMailerAutoload.php');

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->From = "support@quakbox.com";
$mail->FromName = 'Mailer';
$mail->addAddress("naresh.shaw@gmail.com");                            // Add a recipient
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->Subject = "test";
$mail->Body    ="body13231231  ad aad ads ";


if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo 'Message has been sent';
}


   error_reporting( E_ALL );
    $from = "support@quakbox.com";
    $to = "naresh.shaw@gmail.com";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
*/	

?>
<!DOCTYPE HTML> <html lang="PR-BR"> <head> <meta charset="UTF-8"> </head> <body> 
<form>   <label for="age">Age: <input type="text" name="age" value="<?php echo $_REQUEST['age'];?>"><br>    </form> 


</body></html>
