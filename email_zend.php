<?php 
require dirname(__FILE__).'/vendor/autoload.php';
use Zend\Mail;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

$transport = new SmtpTransport();
$options   = new SmtpOptions([
    'name'              => 'smtp.gmail.com',
    'host'              => '127.0.0.1',
    'port'              => 465,
    // Notice port change for TLS is 587
    'connection_class'  => 'plain',
    'connection_config' => [
        'username' => 'maincompany.bpo@gmail.com',
        'password' => 'BPOOutfit',
        'ssl'      => 'ssl',
    ],
]);
$transport->setOptions($options);

/* $config = array('auth' => 'login',
                'username' => 'maincompany.bpo@gmail.com',
                'password' => 'BPOOutfit',				
                'ssl' => 'tls');
$transport = new Mail\Transport\Sendmail('smtp.gmail.com', $config); */

$mail = new Mail\Message();
$mail->setBody('This is the text of the email.');
$mail->setFrom('maincompany.bpo@gmail.com', 'BPO Outfit Sdn Bhd');
$mail->addTo('arief.hilmi@gmail.com', 'Arief Hilmi');
$mail->setSubject('TestSubject');

//$transport = new Mail\Transport\Sendmail();
try
{		
	$transport->send($mail);
	//$mail->send($transport);
}
catch(Exception $e)
{
	echo '<pre>';
	print_r($e);
	echo '</pre>';
}
echo 'here';die;

?>