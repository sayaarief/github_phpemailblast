<?php

// $email and $message are the data that is being
// posted to this page from our html contact form
$email = $_REQUEST['email'] ;
$cc_email = $_REQUEST['cc_email'];

$message = $_REQUEST['message'] ;

// When we unzipped PHPMailer, it unzipped to
// public_html/PHPMailer_5.2.0
require "PHPMailer5.2/PHPMailerAutoload.php";

$mail = new PHPMailer();    

// set mailer to use SMTP
$mail->IsSMTP();

// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
$mail->Host = "tls://smtp.gmail.com";  // specify main and backup server
//$mail->Host = "mail.i3teamworks.com";

$mail->SMTPAuth = true;     // turn on SMTP authentication
$mailer->SMTPSecure = 'tls';
$mailer->Port = 587;
$mail->SMTPDebug = 1;

// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
// email: send_from_PHPMailer@bradm.inmotiontesting.com
// pass: password
$mail->Username = "maincompany.bpo@gmail.com";  // SMTP username
$mail->Password = "BPOOutfit"; // SMTP password

//$mail ->Username = "tms@i3teamworks.com";
//$mail->Password = "ege3%2Qcbkfp";

// $email is the user's email address the specified
// on our contact us page. We set this variable at
// the top of this page with:
// $email = $_REQUEST['email'] ;
$mail->SetFrom('maincompany.bpo@gmail.com');
$mail->From = 'maincompany.bpo@gmail.com';

$mail->SMTPOptions = array(
					'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true,
					)
				);

// below we want to set the email address we will be sending our email to.
//$mail->AddAddress("arief@m3online.com", "Arief Hilmi");

$mail->AddAddress($email);

/* $cc_recipients = explode(",", $cc_email);
foreach($cc_recipients as $cc)
{	
	$mail->AddCC($cc, $cc);
} */

// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);

$mail->Subject = "You have received feedback from your website!";

/* date_default_timezone_set("Asia/Kuala_Lumpur");
$start_date = '2018-10-02 09:30';
$start_time_rfc = date("c", strtotime($start_date));

$end_date = '2018-10-02 12:30';
$end_time_rfc = date("c", strtotime($end_date)); */

// $message is the user's message they typed in
// on our contact us page. We set this variable at
// the top of this page with:
// $message = $_REQUEST['message'] ;
$message .= '<html>
<head>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Event",
  "name": "MT-00060 i3TeamWorks Dev Meeting",
  "startDate": "2018-10-03T08:30:00",
  "endDate": "2018-10-03T12:30:00",
  "location": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "name": "M3 Technologies (ASIA) Berhad",
      "streetAddress": "Persiaran Tropicana",
      "addressLocality": "Petaling Jaya",
      "addressRegion": "Selangor",
      "postalCode": "47410",
      "addressCountry": "Malaysia"
    }
  },
  "potentialAction": [
    {
      "@type": "RsvpAction",
      "rsvpResponse": "yes",
      "handler": {
        "@type": "HttpActionHandler",
        "url": "https://m3.i3teamworks.com/mt_arief_rsvp.php?mt_id=1689&gid=490&s=1"
      },
      "attendance": "http://schema.org/RsvpAttendance/Yes"
    },
    {
      "@type": "RsvpAction",
      "rsvpResponse": "no",
      "handler": {
        "@type": "HttpActionHandler",
        "url": "https://m3.i3teamworks.com/mt_arief_rsvp.php?mt_id=1689&gid=490&s=2"
      },
      "attendance": "http://schema.org/RsvpAttendance/No"
    },
    {
      "@type": "RsvpAction",
      "rsvpResponse": "maybe",
      "handler": {
        "@type": "HttpActionHandler",
        "url": "https://m3.i3teamworks.com/mt_arief_rsvp.php?mt_id=1689&gid=490&s=3"
      },
      "attendance": "http://schema.org/RsvpAttendance/Maybe"
    }
  ]
}
</script>
  </head>
  <body>
    <p>
      MT-00060 i3TeamWorks Dev Meeting
    </p>
    <p>            
      Event: MT-00060 i3TeamWorks Dev Meeting<br/>
      When: Sep 3rd 2018 8:30am GMT+8<br/>
      Venue: M3 Technologies (ASIA) Berhad, Persiaran Tropicana, Petaling Jaya, Selangor, Malaysia 47410<br/>      
    </p>
  </body>
</html>';
$mail->Body    = $message;
$mail->AltBody = $message;

/* $mail->DKIM_domain = 'localhost';
$mail->DKIM_private = 'publickey.key';
$mail->DKIM_selector = '1538463728.demo._domainkey.localhost';
$mail->DKIM_passphrase = '';
$mail->DKIM_identity = $mail->From; */

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: ";
   echo '<pre>';
   print_r($mail->ErrorInfo);
   echo '</pre>';
   exit;
}

echo "Message has been sent";
?>