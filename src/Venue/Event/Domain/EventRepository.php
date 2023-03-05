<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

interface EventRepository
{
    public function save(Event $aggregate): void;
}