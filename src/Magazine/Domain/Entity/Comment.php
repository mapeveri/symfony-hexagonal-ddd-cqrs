<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Entity;

use DateTime;
use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Entity\User;

final class Comment
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Post
     */
    private $post;

    /**
     * @var boolean
     */
    private $hidden;

    /**
     * @var DateTime
     */
    private $created;
    /**
     * @var DateTime
     */
    private $updated;

    public function __construct(string $id, string $content, User $user, Post $post, ?bool $hidden = false)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
        $this->post = $post;
        $this->hidden = $hidden;
        $this->created = new DateTime();
        $this->updated = new DateTime();
    }

    public static function create(string $id, string $content, User $user, Post $post, ?bool $hidden = false): self
    {
        return new self($id, $content, $user, $post, $hidden);
    }

    public function id(): string
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
