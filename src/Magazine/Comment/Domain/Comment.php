<?php

declare(strict_types=1);

namespace App\Magazine\Comment\Domain;

use App\Magazine\Comment\Domain\ValueObjects\CommentId;
use App\Magazine\Post\Domain\Post;
use App\Magazine\User\Domain\User;
use App\Shared\Domain\Aggregate\AggregateRoot;
use DateTime;

class Comment extends AggregateRoot
{
    private DateTime $created;
    private DateTime $updated;

    public function __construct(
        private CommentId $id,
        private string $content,
        private User $user,
        private Post $post,
        private ?bool $hidden = false
    ) {
        $this->created = new DateTime();
        $this->updated = new DateTime();
    }

    public static function create(CommentId $id, string $content, User $user, Post $post, ?bool $hidden = false): self
    {
        return new self($id, $content, $user, $post, $hidden);
    }

    public function id(): CommentId
    {
        return $this->id;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function post(): Post
    {
        return $this->post;
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
}
