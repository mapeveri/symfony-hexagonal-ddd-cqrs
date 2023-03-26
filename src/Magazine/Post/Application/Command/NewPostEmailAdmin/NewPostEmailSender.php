<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\NewPostEmailAdmin;

use App\Magazine\Post\Domain\SendEmailAdmin;

final class NewPostEmailSender
{
    public function __construct(private SendEmailAdmin $emailService)
    {
    }

    public function __invoke(string $id, string $title, string $content): void
    {
        $content = "New post -> $id -> $title -> $content";
        $this->emailService->send("New post", $content);
    }
}
