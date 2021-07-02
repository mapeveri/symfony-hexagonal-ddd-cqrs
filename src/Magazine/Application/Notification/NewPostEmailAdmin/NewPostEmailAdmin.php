<?php

declare(strict_types=1);

namespace App\Magazine\Application\Notification\NewPostEmailAdmin;

use App\Magazine\Domain\Bus\Command\Command;
use App\Magazine\Domain\Email\Post\SendEmailAdmin;

final class NewPostEmailAdmin
{
    private SendEmailAdmin $emailService;

    public function __construct(SendEmailAdmin $emailService)
    {
        $this->emailService = $emailService;
    }

    public function __invoke(string $title, string $content): void
    {
        $content = "New post: $title -> $content";
        $this->emailService->send("New post", $content);
    }
}
