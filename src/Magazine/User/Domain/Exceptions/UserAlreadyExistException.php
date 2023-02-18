<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain\Exceptions;

use App\Shared\Domain\DomainError;

final class UserAlreadyExistException extends DomainError
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'user_already_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The user <%s> already exist', $this->username);
    }
}
