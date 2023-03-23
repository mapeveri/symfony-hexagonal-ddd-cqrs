<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain\Exceptions;

use App\Shared\Domain\DomainError;

final class EventNotExistException extends DomainError
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'event_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The event <%s> does not exist', $this->id);
    }
}
