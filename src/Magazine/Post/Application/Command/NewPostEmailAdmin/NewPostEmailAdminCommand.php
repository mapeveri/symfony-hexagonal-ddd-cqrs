<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\NewPostEmailAdmin;

use App\Shared\Domain\Bus\Command\Command;

final class NewPostEmailAdminCommand implements Command
{
    public function __construct(private string $id, private string $title, private string $content)
    {
    }

    public function id(): string
    {
        return $this->id;
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
