<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}