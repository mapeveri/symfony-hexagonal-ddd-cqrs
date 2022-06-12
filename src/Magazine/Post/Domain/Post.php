<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

use App\Magazine\Category\Domain\Category;
use App\Magazine\Post\Domain\Event\PostWasCreatedEvent;
use App\Magazine\Post\Domain\ValueObjects\PostId;
use App\Magazine\User\Domain\User;
use App\Shared\Domain\Aggregate\AggregateRoot;
use DateTime;

class Post extends AggregateRoot
{
    private DateTime $created;
    private DateTime $updated;
    private $comments;

    public function __construct(
        private PostId $id,
        private string $title,
        private string $content,
        private Category $category,
        private User $user,
        private ?bool $hidden = false
    ) {
        $this->created = new DateTime();
        $this->updated = new DateTime();
        $this->comments = [];
    }

    public static function create(PostId $id, string $title, string $content, Category $category, User $user, ?bool $hidden = false): self
    {
        $post = new self($id, $title, $content, $category, $user, $hidden);
        $post->record(
            new PostWasCreatedEvent(
                $id->value(),
                $title,
                $content,
                $category->id()->value(),
                $user->id()->value(),
                $hidden
            )
        );

        return $post;
    }

    public function id(): PostId
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

    public function category(): Category
    {
        return $this->category;
    }

    public function user(): User
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

    public function updated(): DateTime
    {
        return $this->updated;
    }

    public function comments(): array
    {
        return $this->comments;
    }
}
