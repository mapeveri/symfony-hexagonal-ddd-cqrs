<?php

declare(strict_types=1);

namespace App\Magazine\Application\Notification\NewPostEmailAdmin;

use App\Magazine\Shared\Domain\Bus\Command\Command;

final class NewPostEmailAdminCommand implements Command
{
    private string $title;
    private string $content;

    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }
}
