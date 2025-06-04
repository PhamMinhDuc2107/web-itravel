<?php
   namespace Mailer;
   use Mailer\Mailable;
   class OrderMail extends Mailable {
      public function __construct(array $data) {
         $data['page'] = "order";
         $this->subject("Chào mừng bạn, 1!")
                  ->view(_DIR_ROOT . '/app/views/layouts/mail_layout.view.php', data: $data);
      }
   }