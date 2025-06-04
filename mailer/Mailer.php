<?php
   namespace Mailer;

   require_once _DIR_ROOT . '/vendor/autoload.php';

   use Mailer\MailerInterface;
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   class Mailer implements MailerInterface {
      protected PHPMailer $mailer;

      public function __construct()
      {
         $this->mailer = new PHPMailer(true);
         $this->mailer->SMTPDebug = 0; 
         $this->mailer->isSMTP();
         $this->mailer->Host =$_ENV["MAIL_HOST"] ?? 'smtp.gmail.com';
         $this->mailer->SMTPAuth = true;
         $this->mailer->Username = $_ENV["MAIL_USERNAME"] ?? '';
         $this->mailer->Password = $_ENV["MAIL_PASSWORD"] ?? '';
         $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
         $this->mailer->Port =  $_ENV["MAIL_PORT"] ?? 587;
         $this->mailer->AddEmbeddedImage(_DIR_ROOT . '/public/assets/client/images/itravel.png', 'logo_cid');
         $this->mailer->setFrom($_ENV['MAIL_USERNAME'], 'Itravel');
         $this->mailer->isHTML(true);
         $this->mailer->CharSet = 'UTF-8';
      }

      public function send(Mailable $mailable): bool
      {
         try {
               $this->mailer->clearAllRecipients();
               $this->mailer->addAddress($mailable->getTo());
               $this->mailer->Subject = $mailable->getSubject();
               $this->mailer->Body = $mailable->getBody();
            
               return $this->mailer->send();
         } catch (Exception $e) {
               error_log("Mail error: " . $e->getMessage());
               return false;
         }
      }
   }
