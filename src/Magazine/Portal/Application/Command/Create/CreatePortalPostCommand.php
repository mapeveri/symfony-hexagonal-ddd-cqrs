<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Command\Create;

use App\Shared\Domain\Bus\Command\Command;

final class CreatePortalPostCommand implements Command
{
    public function __construct(private string $id, private array $data)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function data(): array
    {
        return $this->data;
    }
}