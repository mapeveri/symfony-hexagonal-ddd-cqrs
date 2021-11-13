<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain;

use DateTime;

final class User
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $isActive;

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
    private $posts;

    /**
     * @var array
     */
    private $comments;

    public function __construct(string $id, string $username, string $email, string $password, bool $isActive)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->isActive = $isActive;
        $this->created = new DateTime();
        $this->updated = new DateTime();
        $this->posts = [];
        $this->comments = [];
    }

    public static function create(string $id, string $username, string $email, string $password, ?bool $isActive): self
    {
        return new self($id, $username, $email, $password, $isActive);
    }

    public function id(): string
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
