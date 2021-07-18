<?php

declare(strict_types=1);

namespace App\Magazine\Application\User\Create;

use App\Magazine\Shared\Domain\Bus\Command\Command;

final class UserCreateCommand implements Command
{
    private string $username;
    private string $email;
    private string $password;
    private bool $isActive;

    public function __construct(string $username, string $email, string $password, bool $isActive)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->isActive = $isActive;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
