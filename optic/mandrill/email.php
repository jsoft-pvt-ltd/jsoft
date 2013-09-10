<?php

include_once "lib/swift_required.php";

$subject = 'Hello from Mandrill, PHP!';
// approved domains only!
$from = array('anjin@steamtees.com' =>'Anjin Pradhan');
$to = array(
 'anjin_pradhan@hotmail.com'  => 'Recipient1 Name',
 'anjinpradhan@live.com' => 'Recipient2 Name'
);

$text = "Mandrill speaks plaintext";
$html = "Mandrill speaks HTML<a href='http://steamtees.com/'>MANDRILL</a>";

$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
$transport->setUsername("anjin_pradhan@hotmail.com");
$transport->setPassword("d07702df-60c2-4a47-a664-f33ed69490fd");
$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject);
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($to);
$message->addPart($text, 'text/plain');

if ($recipients = $swift->send($message, $failures))
{
 echo 'Message successfully sent!';
} else {
 echo "There was an error:\n";
 print_r($failures);
}

?>