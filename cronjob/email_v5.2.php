<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');

require "../PHPMailer5.2/PHPMailerAutoload.php";
//require_once('phpmailer_v5.2/PHPMailerAutoload.php'); //added for PHPMailer v5.2

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 1;

//Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//$mail->Host = 'webmail.xox.my';
//$mail->Host = 'mail.i3teamworks.com';
//$mail->Host = 'mail.m3online.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 25;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

$mail->SMTPOptions = array(
    'ssl' => array(
		'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
    )
);

//$mail->Username = "tms-noreply@i3teamworks.com";
//$mail->Password = "6tdGZwtvG*rc";
//$sender_port= 25; 
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "maincompany.bpo@gmail.com";
//$mail->Username = "xoxi3tw";
//$mail->Username = "arief";

//Password to use for SMTP authentication
$mail->Password = "BPOOutfit";
//$mail->Password = "azril@123";
//$mail->Password = "arief123";

//Set who the message is to be sent from
//$mail->setFrom('xoxi3tw@xox.com.my', 'M3OnlineTest');

//Set an alternative reply-to address
//$mail->addReplyTo('xoxi3tw@xox.com.my', 'M3OnlineTest');

//Set who the message is to be sent to
//$email = $_REQUEST['email'];
$mail->addAddress("arief.hilmi@gmail.com", 'arief hilmi');

//Set the subject line
$mail->Subject = 'PHPMailer v5.2 SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
$message = "Test message" ;
$mail->Body    = $message;

//Attach an image file
$mail->addAttachment('files/1/201709/annual_listinfg_fee.pdf');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}