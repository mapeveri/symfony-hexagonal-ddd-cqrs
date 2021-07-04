<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Create;

use App\Magazine\Domain\Bus\Command\Command;

final class PostCreateCommand implements Command
{
    private int $category;
    private int $user;
    private string $title;
    private string $content;
    private bool $hidden;

    public function __construct(string $title, string $content, int $category, int $user, bool $hidden)
    {
        $this->category = $category;
        $this->user = $user;
        $this->title = $title;
        $this->content = $content;
        $this->hidden = $hidden;
    }

    public function category(): int
    {
        return $this->category;
    }

    public function user(): int
    {
        return $this->user;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }
}
