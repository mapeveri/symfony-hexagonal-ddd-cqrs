<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Notification\Post;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Magazine\Domain\Email\Post\SendEmailAdmin;

final class NewPostEmailAdmin implements SendEmailAdmin
{
    private string $emailAdmin;
    private string $fromEmail;
    private MailerInterface $mailer;

    public function __construct(string $emailAdmin, string $fromEmail, MailerInterface $mailer) 
    {
        $this->emailAdmin = $emailAdmin;
        $this->fromEmail = $fromEmail;
        $this->mailer = $mailer;
    }

    public function send(string $title, string $content): void
    {
        $email = (new Email())
            ->from($this->fromEmail)
            ->to($this->emailAdmin)
            ->subject($title)
            ->html($content);

        $this->mailer->send($email);
    }
}
