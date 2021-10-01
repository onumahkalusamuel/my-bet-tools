<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Psr\Container\ContainerInterface;

class SendMail
{
    public $mail;
    private $settings;
    private $siteName;
    private $siteUrl;
    private  $contactPhone;
    private  $contactName;
    private  $contactEmail;
    private  $contactAddress;
    private $emailBanner;

    public function __construct(ContainerInterface $container)
    {

        $this->settings = $container->get('settings');
        $smtp = $this->settings['smtp'];

        $this->contactName = $smtp['name'];
        $this->siteName = "my-bet-tools";
        $this->contactPhone = "";
        $this->contactAddress = "";
        $this->contactEmail = $smtp['email'];
        $this->siteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';

        $mail = new PHPMailer(true);
        
        if (gethostname() == 'localhost') {
            $mail->isMail();
        } else {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Password = $smtp['password'];
            $mail->Username = $smtp['email'];
            $mail->Host = $smtp['host'];
            $mail->Port = $smtp['port'];
        }

        $mail->setFrom($smtp['email'], $smtp['name']);
        $mail->addReplyTo($smtp['email'], $this->smtp['name']);

        // Content
        $mail->isHTML(true);

        $this->mail = $mail;
    }

    public function send(array $data)
    {

        $this->mail->clearAllRecipients();

        extract($data);

        try {
            $this->mail->addAddress($email, $name);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $message;
            $this->mail->send();
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $this->mail->ErrorInfo];
        }
    }

    public function sendContactMail(array $form)
    {

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Contact Us: " . $form['subject'];
        $data['message'] =
            "<strong>Feedback Form:</strong><br/><br/>" .
            "<p><strong>Name:</strong><br/>" . $form['name'] . "</p>" .
            "<p><strong>Email:</strong><br/>" . $form['email'] . "</p>" .
            "<p><strong>Suject:</strong><br/>" . $form['subject'] . "</p>" .
            "<p><strong>Message:</strong><br/>" . $form['message'] . "</p>";

        return $this->send($data);
    }

    public function sendPasswordResetEmail($email, $name, $token)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Password Reset Email - " . $this->siteName;
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>" .
            "<h2>PASSWORD RESET</h2><br/>" .
            "Hello $name, <br/><br/>
            We received a password reset request from you.<br/> <br/>
        If you are the one, please kindly click on the link below to reset your password.<br/><br/>
        <strong><a href='{$this->siteUrl}/reset/{$token}/{$email}'>RESET PASSWORD NOW</a></strong><br/>
        <br>
        If you are unable to click on the link, please kindly copy the following to your browser.<br/><br/>
        <h4>{$this->siteUrl}/reset/{$token}/{$email}</h4>
        <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a><br>
            </div>
        ";

        return $this->send($data);
    }

    public function sendRegistrationEmail($email, $name, $username)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Registration Info - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>
        <h2>REGISTRATION SUCCESSFUL</h2><br/>
        Hello <strong>$name</strong>,<br/><br/>
        Thank you for registration on our site.<br/>
        <strong>Your login information:</strong><br/><br/>
        <strong>Login:</strong> $username <br/>
        <strong>Password:</strong> <em>the password you chose </em><br/><br/>
        You can login here: <a href='{$this->siteUrl}/'>{$this->siteName}</a><br/><br/>
        Contact us immediately if you did not authorize this registration.<br/><br/>
        
        <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a><br>
            </div>";

        return $this->send($data);
    }

}
