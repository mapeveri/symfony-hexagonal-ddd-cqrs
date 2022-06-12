<?php

declare(strict_types=1);

namespace App\Magazine\Post\Infrastructure\Notification\Post;

use App\Magazine\Post\Domain\SendEmailAdmin;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

final class NewPostEmailAdmin implements SendEmailAdmin
{
    public function __construct(private string $emailAdmin, private string $fromEmail, private MailerInterface $mailer)
    {
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
