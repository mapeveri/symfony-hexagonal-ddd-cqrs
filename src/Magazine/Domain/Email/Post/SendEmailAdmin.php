<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Email\Post;

interface SendEmailAdmin
{
    public function send(string $title, string $content): void;
}
