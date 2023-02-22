<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Domain;

final class PortalPost
{
    public function __construct(private string $id, private string $title, private string $content)
    {
    }

    public static function create(string $id, string $title, string $content): self
    {
        return new self($id, $title, $content);
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

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'content' => $this->content(),
        ];
    }
}