<?php
namespace Mailer;

require_once _DIR_ROOT . '/vendor/autoload.php';
use Mailer\Mailable;
interface MailerInterface {
   public function send(Mailable $mailable): bool;
}
