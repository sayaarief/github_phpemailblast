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
$mail->Host = "smtp.gmail.com";  // specify main and backup server
//$mail->Host = "mail.i3teamworks.com";

$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->SMTPSecure = "tls";
$mail->Port = 465;
$mail->SMTPDebug = 2;

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
//$mail->SetFrom('maincompany.bpo@gmail.com');
$mail->From = $email;

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
  "name": "Taco Night",
  "startDate": "2027-04-18T15:30:00Z",
  "endDate": "2027-04-18T16:30:00Z",
  "location": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "name": "Google",
      "streetAddress": "24 Willie Mays Plaza",
      "addressLocality": "San Francisco",
      "addressRegion": "CA",
      "postalCode": "94107",
      "addressCountry": "USA"
    }
  },
  "potentialAction": [
    {
      "@type": "RsvpAction",
      "rsvpResponse": "yes",
      "handler": {
        "@type": "HttpActionHandler",
        "url": "http://mysite.com/rsvp?eventId=123&value=yes"
      },
      "attendance": "http://schema.org/RsvpAttendance/Yes"
    },
    {
      "@type": "RsvpAction",
      "rsvpResponse": "no",
      "handler": {
        "@type": "HttpActionHandler",
        "url": "http://mysite.com/rsvp?eventId=123&value=no"
      },
      "attendance": "http://schema.org/RsvpAttendance/No"
    },
    {
      "@type": "RsvpAction",
      "rsvpResponse": "maybe",
      "handler": {
        "@type": "HttpActionHandler",
        "url": "http://mysite.com/rsvp?eventId=123&value=maybe"
      },
      "attendance": "http://schema.org/RsvpAttendance/Maybe"
    }
  ]
}
</script>
  </head>
  <body>
    <p>
      Dear John, thanks for booking your Google I/O ticket with us.
    </p>
    <p>
      BOOKING DETAILS<br/>
      Order for: John Smith<br/>
      Event: Google I/O 2013<br/>
      When: May 15th 2013 8:30am PST<br/>
      Venue: Moscone Center, 800 Howard St., San Francisco, CA 94103<br/>
      Reservation number: IO12345<br/>
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
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";
?>