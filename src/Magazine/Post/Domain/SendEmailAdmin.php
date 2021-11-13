<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

interface SendEmailAdmin
{
    public function send(string $title, string $content): void;
}
