<?php

namespace dvds4u;

class Emailer
{
    private $to, $subject, $body, $site;

    // Constructs a new e-mail object setting required values
    public function __construct($to, $hash)
    {
        $this->site = 'localhost:8000';
        $this->to = $to;
        $this->subject = 'DO NOT REPLY - DVDs 4 U Email Verification';
        $this->body = $this->getBody($to, $hash);
    }

    // Creates the e-mail and sends it
    public function sendEmail()
    {
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername('donotreply.dvds4u')
            ->setPassword('W^x j^m 1n s3v3n c0l0urs');

        $mailer = \Swift_Mailer::newInstance($transport); // Create mailer using transport

        // Create message
        $message = \Swift_Message::newInstance($this->subject)
            ->setFrom(['donotreply.dvds4u@gmail.com' => 'DO NOT REPLY'])
            ->setTo([$this->to])
            ->setBody($this->body);

        // Send message
        try {
            $mailer->send($message);
            return true;
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    // Template body with user specific fields
    private function getBody($to, $hash)
    {
        return '
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

------------------------
Username: ' . $to . '
------------------------

Please click this link to activate your account:
http://' . $this->site . '/verify.php?email=' . $to . '&hash=' . $hash . '

';
    }

}