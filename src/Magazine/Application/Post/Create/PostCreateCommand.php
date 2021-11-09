<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Create;

use App\Magazine\Shared\Domain\Bus\Command\Command;

final class PostCreateCommand implements Command
{
    private string $category;
    private string $user;
    private string $title;
    private string $content;
    private bool $hidden;

    public function __construct(string $title, string $content, string $category, string $user, bool $hidden)
    {
        $this->category = $category;
        $this->user = $user;
        $this->title = $title;
        $this->content = $content;
        $this->hidden = $hidden;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function user(): string
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
