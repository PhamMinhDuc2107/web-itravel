<?php
namespace Mailer;
abstract class Mailable {
    protected string $to;
    protected string $subject;
    protected string $view;
    protected array $data = [];

    public function to(string $email): self {
        $this->to = $email;
        return $this;
    }

    public function subject(string $subject): self {
        $this->subject = $subject;
        return $this;
    }

    public function view(string $view, array $data = []): self {
        $this->view = $view;
        $this->data = $data;
        return $this;
    }

    public function getTo(): string { return $this->to; }
    public function getSubject(): string { return $this->subject; }
    public function getBody(): string {
        extract($this->data);
        ob_start();
        require $this->view;
        return ob_get_clean();
    }
}
