<?php

require_once "functions_settings.php";
require_once "functions_log.php";

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\TransportFactoryInterface;

$transport = null;

function send_text_mail($to, $subject, $messagetext, $attachments, $addsendertobcc, $debug, $from_name = "", $from_mail = "", $settings = NULL)
{
    return send_mail($to, $subject, $messagetext, $attachments, 'text/plain', $addsendertobcc, $debug, $from_name, $from_mail, $settings);
}
function send_association_html_mail($association, $to, $subject, $messagetext, $attachments, $addsendertobcc, $debug)
{
    return send_mail($to, $subject, $messagetext, $attachments, 'text/html', $addsendertobcc, $debug, $association['name'], '', $association);
}

function send_html_mail($to, $subject, $messagetext, $attachments, $addsendertobcc, $debug, $from_name = "", $from_mail = "", $settings = NULL)
{
    return send_mail($to, $subject, $messagetext, $attachments, 'text/html', $addsendertobcc, $debug, $from_name, $from_mail, $settings);
}   

function send_mail($to, $subject, $messagetext, $attachments, $type, $addsendertobcc, $debug = FALSE, $from_name = "", $from_mail = "", $settings = NULL)
{ 	
	$error = '';
	$tries = 3;
    $test_mail = trim(Config::TEST_EMAIL);
    if (!$settings)
        $settings = get_settings();
	while ($tries--)
	{
		try
	   {
		   $error = '';
		   $tos = explode(';', $to);
		   if (trim($from_mail) == '')
		   {
				$from_mail = $settings['smtp_mail'];
		   }
		   if (trim($from_name) == '')
		   {
				$from_name = $settings['smtp_sender'];
		   }
           if ($test_mail != '')
           {
               $intro = trim(Config::TEST_EMAIL_INTRO);
               if ($intro == '')
                   $intro = 'Testmail: ';
               $subject = $intro . $subject;
           }
		   $email = (new Email())
				->from(new Address($from_mail, $from_name))
				->subject($subject);
           if ($test_mail != '')
           {
               $targets = 'Eigentliche Empfänger:';
               foreach ($tos as $to)
               {
                   $targets .= $to . '; ';
               }
               if ($addsendertobcc)
               {
                   $targets .= 'BCC: ' . $from_mail . ' ' . $from_name;
               }
               $messagetext = $targets . '\n\n<br><br>' . $messagetext;
               $tos = explode(';', $test_mail);
               foreach ($tos as $to)
               {
                   $email->addTo($to);
               }
           }
           else
           {
               foreach ($tos as $to)
               {
                   $email->addTo($to);
               }
               if ($addsendertobcc)
               {
                   $email->bcc(new Address($from_mail, $from_name));
               }
           }
			if ($type == 'text/plain')
				$email->text($messagetext);
			else
				$email->html($messagetext);

			foreach ($attachments as $att)
			{
				$email->addPart(new DataPart(new File($att["name"])));
			}

			$mailer = new Mailer(get_transport($settings));
			$mailer->send($email);
			break;
	   }
		catch (Swift_TransportException $e) 
		{
		   log_error("send_mail transport: " . $e->getMessage());
		   $error = "Fehler beim Senden der Email";
		   reset_transport();
		}
		catch(\Exception $e)
	   {
		   log_error("send_mail: " . $e->getMessage());
		   $error = "Fehler beim Senden der Email";
		}
	}
    return $error;
}   


function get_transport($settings)
{
	global $transport;
	if ($transport == null)
	{
		$transport = Transport::fromDsn('smtp://' . $settings['smtp_user'] . ':' . $settings['smtp_password'] . '@' . $settings['smtp_host'] . ':' . $settings['smtp_port'] . '/?encryption=' . $settings['smtp_transport']);
	}
	return $transport;
}


function reset_transport()
{
	global $transport;
	if ($transport)
	{
        try {
            // Try to stop
           $transport->stop();
		   sleep(10);
        }
		catch (\Swift_TransportException  $e) 
		{
			log_error("reset_transport transport: " . $e->getMessage());
            // Got Exception while stopping transport.
            // We have to set _started to 'false' manually, because due to an exception it is 'true' now.
            $reflection = new \ReflectionClass($transport);
            $prop = $reflection->getProperty('_started');
            $prop->setAccessible(true);
            $prop->setValue(false);
            $prop->setAccessible(false);
        }
		catch (\Exception  $e) 
		{
			log_error("reset_transport: " . $e->getMessage());
			$transport = null;
		}
	}
}