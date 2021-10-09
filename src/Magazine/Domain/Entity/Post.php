<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Entity;

use DateTime;
use App\Magazine\Domain\Entity\User;
use App\Magazine\Domain\Entity\Category;
use App\Magazine\Shared\Domain\Event\EventsDomain;
use App\Magazine\Domain\Post\PostWasCreatedEvent;

final class Post
{
    use EventsDomain;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var User
     */
    private $user;

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

    /**
     * @var array
     */
    private $comments;

    public function __construct(string $title, string $content, Category $category, User $user, ?bool $hidden = false)
    {
        $this->title = $title;
        $this->content = $content;
        $this->category = $category;
        $this->user = $user;
        $this->hidden = $hidden;
        $this->created = new DateTime();
        $this->updated = new DateTime();
        $this->comments = [];
    }

    public static function create(string $title, string $content, Category $category, User $user, ?bool $hidden = false): self
    {
        $post = new self($title, $content, $category, $user, $hidden);

        $post->record(new PostWasCreatedEvent($title, $content, $category->id(), $user->id(), $hidden));

        return $post;
    }

    public function id(): int
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
