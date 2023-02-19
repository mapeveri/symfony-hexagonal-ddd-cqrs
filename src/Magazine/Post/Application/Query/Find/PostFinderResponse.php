<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Query\Find;

use App\Shared\Domain\Bus\Query\Response;
use DateTime;

final class PostFinderResponse implements Response
{
    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $category,
        private string $user,
        private ?bool $hidden,
        private DateTime $created,
    ) {
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

    public function category(): string
    {
        return $this->category;
    }

    public function user(): string
    {
        return $this->user;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }

    public function created(): DateTime
    {
        return $this->created;
    }

    public function data(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'content' => $this->content(),
            'user' => $this->user(),
            'hidden' => $this->hidden(),
            'category' => $this->category(),
            'created' => $this->created(),
        ];
    }
}
