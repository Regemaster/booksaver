<?php

require_once 'PHPMailer/PHPMailerAutoload.php';

class EmailSender
{

    public function sendEmail($to, $subject, $msg)
    {
        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer;
        $mail->isSMTP();

        /*
         * Server Configuration
         */
        $mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
        $mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
        $mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
        $mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
        $mail->Username = "lukaszoswald92@gmail.com"; // Your Gmail address.
        $mail->Password = "nbokbytniirfxjic"; // Your Gmail login password or App Specific Password.
        $mail->setFrom('webservice@booksaver.rf.gd', 'Booksaver'); // Set the sender of the message.
        
        /*
         * Message Configuration
         */
        $mail->addAddress($to); // Set the recipient of the message.
        $mail->Subject = $subject; // The subject of the message.
        
        /*
         * Message Content - Choose simple text or HTML email
         */

        // Choose to send either a simple text email...
        $mail->Body = $msg; // Set a plain text body.
        // ... or send an email with HTML.
        //$mail->msgHTML(file_get_contents('contents.html'));
        // Optional when using HTML: Set an alternative plain text message for email clients who prefer that.
        //$mail->AltBody = 'This is a plain-text message body'; 
        // Optional: attach a file
        //$mail->addAttachment('images/phpmailer_mini.png');
        
        if ($mail->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function sendChangePasswordEmail($to, $UserName, $UserEmail, $msg)
    {
        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
        $mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
        $mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
        $mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
        $mail->Username = "lukaszoswald92@gmail.com"; // Your Gmail address.
        $mail->Password = "nbokbytniirfxjic"; // Your Gmail login password or App Specific Password.
        $mail->setFrom('webservice@booksaver.rf.gd', 'Booksaver'); // Set the sender of the message.

        $mail->addAddress($to);
        $mail->Subject = 'Booksaver password change request';

        $mail->Body = "Hello $UserName,\n".
                    "This e-mail was sent to you, because you recently requested for change password. To do this, please enter the link below:\n\n".
                    'http://'.$_SERVER['SERVER_NAME'].'/?controller=login&action=changePassword&r='.$msg.'&e='.$UserEmail."\n\n".
                    "Best regards\n".
                    "Booksaver";

        if ($mail->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}

?>