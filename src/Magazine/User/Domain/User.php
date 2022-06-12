<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain;

use App\Magazine\User\Domain\ValueObjects\UserId;
use App\Shared\Domain\Aggregate\AggregateRoot;
use DateTime;

class User extends AggregateRoot
{
    private DateTime $created;
    private DateTime $updated;
    private $posts;
    private $comments;

    public function __construct(
        private UserId $id,
        private string $username,
        private string $email,
        private string $password,
        private bool $isActive
    ) {
        $this->created = new DateTime();
        $this->updated = new DateTime();
        $this->posts = [];
        $this->comments = [];
    }

    public static function create(UserId $id, string $username, string $email, string $password, ?bool $isActive): self
    {
        return new self($id, $username, $email, $password, $isActive);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function created(): DateTime
    {
        return $this->created;
    }

    public function updated(): DateTime
    {
        return $this->updated;
    }

    public function posts(): array
    {
        return $this->posts;
    }

    public function comments(): array
    {
        return $this->comments;
    }
}
