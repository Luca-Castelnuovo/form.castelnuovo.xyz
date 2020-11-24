<?php

namespace App\Helpers;

use CQ\Config\Config;
use Exception;
use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;

class MailHelper
{
    /**
     * Send Emails.
     *
     * @param string to
     * @param string subject
     * @param string body
     * @param string fromName optional
     * @param string replyTo optional
     *
     * @throws Exception
     *
     * @return
     */
    public static function send($to, $subject, $body, $fromName = '', $replyTo = '')
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->isHTML(true);

            $mail->Host = Config::get('smtp.host');
            $mail->Port = Config::get('smtp.port');
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->SMTPAuth = true;
            $mail->Username = Config::get('smtp.username');
            $mail->Password = Config::get('smtp.password');

            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->setFrom(Config::get('smtp.username'), $fromName ?: Config::get('smtp.username'));

            if ($replyTo) {
                $mail->addReplyTo($replyTo, $replyTo);
            }

            $mail->send();
        } catch (MailException $e) {
            throw new Exception($mail->ErrorInfo);
        }
    }
}
